<?php

class Controller {

    private $_api;
    private $_view;

    public function setPage( $route ) {

        $this->_api = new Model( $_ENV[ 'API_URL' ] );
        $this->_view = new View();

        switch ( $route ) :
            case null :
            case 'scoreboard' :
                $this->_getScoreboard();
                break;
            case 'games' :
                $this->_getGames();
                break;
            case 'players' :
                $this->_getPlayers();
                break;
            case 'updatePlayer' :
                $this->_updatePlayer();
                break;
            case 'addScore' :
                $this->_addScore();
                break;
            case 'removeGame' :
                $this->_removeGame();
                break;
            default :
                $this->_view->getView( '/404.php' );
                break;
        endswitch;

    }

    /**
     * Set data and view for scoreboard
     */
    private function _getScoreboard() {

        $scores = array();

        $players = $this->_api->getPlayers();
        
        
        if ( ! empty( $players ) ) {
            
            foreach ( $players as $player ) {
                
                $scores[] = array(
                    'id' => $player->id,
                    'name' => $player->name,
                    'stats' => $this->_api->getPlayerStats( $player->id, date( 'Y-m-01'), date( 'Y-m-t' ) )
                );
                
            }
            
        }
        
        $this->_view->getView( '/scoreboard.php', array( 'scores' => $scores ) );
        
    }
    
    /**
     * Set data and view for players
     */
    private function _getPlayers() {

        $players = $this->_api->getPlayers( false );
        
        $this->_view->getView( '/players.php', array( 'players' => $players ) );
        
    }
    
    /**
     * Set data and view for players
     */
    private function _updatePlayer() {
        
        if ( isset( $_POST['player_id'] ) && isset( $_POST['player_active'] ) && isset( $_POST['player_name'] ) ) {
            $this->_api->updatePlayer( intval( $_POST['player_id'] ), array ( 'active' => $_POST['player_active'], 'name' => $_POST['player_name'] ) );
        }
        
        header('Location: /players');
        exit;
        
    }
    
    /**
     * Set data and view for games table
     */
    private function _getGames() {
        
        if ( isset( $_GET['month'] ) ) {
            $start_date = date( 'Y-m-01', strtotime( $_GET['month'] ) );
            $end_date = date( 'Y-m-t', strtotime( $_GET['month'] ) );
        } else {
            $start_date = date( 'Y-m-01' );
            $end_date = date( 'Y-m-t' );
        }
        
        $games = $this->_api->getGames( $start_date, $end_date );

        $this->_view->getView( '/games.php', array( 'games' => $games, 'month' => $start_date, 'players' => $this->_api->getPlayers() ) );

    }
    
    /**
     * Get monthly games
     */
    private function _getMontlyGames( $games, $date = false ) {
        if ( ! $date ) {
            $date = date( 'Y-m' );
        }
        $monthly_games = array();
        foreach ( $games as $game ) {
            $month = date( 'Y-m', strtotime( $game->game->timestamp ) );
            if ( $date === $month ) {
                $monthly_games[] = $game;
            }
        }
        
        return $monthly_games;
    }
    
    /**
     * Sort games, from high ID to low
     */
    private function _sortGames( $a, $b) {
        if ($a->game->id == $b->game->id) {
            return 0;
        }
        return ($a->game->id < $b->game->id) ? 1 : -1;
    }
    
    /**
     * Form post to handle new game victory
     */
    private function _addScore() {
        
        
        if ( isset( $_POST['winner'] ) && isset( $_POST['participants'] ) ) {
            $this->_api->addGame( intval( $_POST['winner'] ), $_POST['participants'] );
        }
        
        // header( sprintf( 'Location: %s', $_SERVER['HTTP_REFERER'] ), true );
        header('Location: /');
        exit;
    }
    
    /**
     * Form post to handle new game victory
     */
    private function _removeGame() {
        
        if ( isset( $_POST['game_id'] ) ) {
            $this->_api->removeGame( intval( $_POST['game_id'] ) );
        }
        
        header( sprintf( 'Location: %s', $_SERVER['HTTP_REFERER'] ), true );
        exit;
    }

}
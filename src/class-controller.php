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
                    'points' => $this->_api->getPlayerPoints( $player->id )
                );

            }

        }

        uasort( $scores, array( $this, '_sortScores') );
        
        $this->_view->getView( '/scoreboard.php', array( 'scores' => $scores ) );
        
    }
    
    /**
     * Set data and view for games table
     */
    private function _getGames() {
        
        $games = $this->_api->getGames();
        
        uasort( $games, array( $this, '_sortGames') );

        $this->_view->getView( '/games.php', array( 'games' => $games ) );

    }
    
    /**
     * Sort player scores, from high to low
     */
    private function _sortScores( $a, $b) {
        if ($a['points'] == $b['points']) {
            return 0;
        }
        return ($a['points'] < $b['points']) ? 1 : -1;
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
        
        if ( isset( $_POST['player_id'] ) ) {
            $this->_api->addGame( intval( $_POST['player_id'] ) );
        }
        
        header( sprintf( 'Location: %s', $_SERVER['HTTP_REFERER'] ), true );
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
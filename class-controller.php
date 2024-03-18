<?php

class Controller {

    private $_api;
    private $_view;

    public function setPage( $route ) {

        $this->_api = new Model( 'http://unoapi.friikod.se' );
        $this->_view = new View();

        switch ( $route ) :
            case null :
                $this->_getScoreboard();
                break;
            default :
                echo '404';
                break;
        endswitch;

    }

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

        uasort( $scores, array( $this, 'sortScores') );

        $this->_view->getView( '/scoreboard.php', array( 'scores' => $scores ) );

    }

    public function sortScores( $a, $b) {
        if ($a['points'] == $b['points']) {
            return 0;
        }
        return ($a['points'] < $b['points']) ? 1 : -1;
    }

}
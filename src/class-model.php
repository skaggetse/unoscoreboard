<?php
/**
 * The Class interracting with the API
 * 
 * 
 */
use Curl\Curl;

class Model {

    private $api_url;


    /**
     * The class constructor
     * 
     * @param   string  $api_url    The URL to the API
     * 
     */
    public function __construct( $api_url ) {

        $this->api_url = $api_url;
        
    }
    
    /**
     * Curl GET orchestration method
     * 
     * @since   beginning of time
     * 
     * @param   string          $api_endpoint   The API Endpoint
     * @return  array|string    The Curl response, string for error.
     */
    private function _get( $api_endpoint ) {
        
        $curl = new Curl();

        $curl->get(
            sprintf(
                '%s/%s',
                $this->api_url,
                $api_endpoint
            )
        );

        if ( $curl->error ) {
            return 'Error: ' . $curl->errorMessage . "\n";
            $curl->diagnose();
        } else {
            return $curl->response;
        }

    }

    /**
     * Curl POST orchestration method
     * 
     * @since   beginning of time
     * 
     * @param   string          $api_endpoint   The API Endpoint
     * @return  array|string    The Curl response, string for error.
     */
    private function _post( $api_endpoint, $body ) {
        
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');

        $curl->post(
            sprintf(
                '%s/%s',
                $this->api_url,
                $api_endpoint
            ),
            $body
        );

        if ( $curl->error ) {
            return 'Error: ' . $curl->errorMessage . "\n";
            $curl->diagnose();
        } else {
            return $curl->response;
        }

    }

    /**
     * Curl GET orchestration method
     * 
     * @since   beginning of time
     * 
     * @param   string          $api_endpoint   The API Endpoint
     * @return  array|string    The Curl response, string for error.
     */
    private function _delete( $api_endpoint ) {
        
        $curl = new Curl();

        $curl->delete(
            sprintf(
                '%s/%s',
                $this->api_url,
                $api_endpoint
            )
        );

        if ( $curl->error ) {
            return 'Error: ' . $curl->errorMessage . "\n";
            $curl->diagnose();
        } else {
            return $curl->response;
        }

    }
    
    /**
     * Get all players
     * 
     * @since   the code is created
     */
    public function getPlayers() {

        return $this->_get( 'player/all' );

    }

    /**
     * Get a specific player
     * 
     * @since   today
     * 
     * @param   int     $id     The Player ID
     */
    public function getPlayer( $id ) {

        return $this->_get( 
            sprintf( 
                'player/%d',
                $id
            ) 
        );

    }

    /**
     * Get a players points
     * 
     * @since   tomorrow
     * 
     * @param   int     $id     The Player ID
     */
    public function getPlayerPoints( $id ) {

        return $this->_get( 
            sprintf( 
                'player/%d/points',
                $id
            ) 
        );

    }

    /**
     * Get all played games
     * 
     */
    public function getGames() {

        return $this->_get( 'game/all' );

    }

    /**
     * Get all played games
     * 
     */
    public function getGame( $id) {

        return $this->_get( 
            sprintf( 
                'game/%d',
                $id
            ) 
        );

    }

    /**
     * Add a played game with its winner
     * 
     * @param   int     $id     The winning player ID
     */
    public function addGame( $id ) {

        return $this->_post( 
            'game',
            array(
                'winner' => $id
            )
        );

    }

    /**
     * Remove a played game
     * 
     * @param   int     $id     The game ID
     */
    public function removeGame( $id ) {

        return $this->_delete( 
            sprintf( 
                'game/%d',
                $id
            ) 
        );

    }
    
}
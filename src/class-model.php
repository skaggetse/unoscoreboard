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
     * Curl PUT orchestration method
     * 
     * @since   beginning of time
     * 
     * @param   string          $api_endpoint   The API Endpoint
     * @param   array|string    $body           The data to send in the PUT request
     * @return  array|string    The Curl response, string for error.
     */
    private function _put( $api_endpoint, $body ) {
        
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');

        $curl->put(
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
    public function getPlayers( $only_active = true ) {

        return $this->_get( sprintf( 'players?only_active=%s', $only_active ) );

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
     * Get a specific player
     * 
     * @since   today
     * 
     * @param   int     $id     The Player ID
     */
    public function updatePlayer( $id, $data ) {

        return $this->_put( 
            sprintf( 
                'player/%d',
                $id
            ),
            $data
        );

    }

    /**
     * Get a players points
     * 
     * @since   tomorrow
     * 
     * @param   int     $id     The Player ID
     */
    public function getPlayerStats( $id, $start_date, $end_date ) {

        return $this->_get( 
            sprintf( 
                'player/%d/stats?%s',
                $id,
                http_build_query(
                    array(
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    )
                )
            ) 
        );

    }

    /**
     * Get all played games
     * 
     */
    public function getGames( $start_date, $end_date ) {

        return $this->_get( 
            sprintf( 
                'games?%s',
                http_build_query(
                    array(
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    )
                )
            ) 
        );

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
    public function addGame( $winner_id, $participants = array() ) {

        $return = $this->_post( 
            sprintf( 'game?%s',
                http_build_query(
                    array(
                        'winner' => $winner_id,
                        'participants' => implode( ',', $participants)
                    )
                )
            ),
            array()
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
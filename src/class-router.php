<?php
/**
 * The web router
 */

class Router {

    private $_controller;

    public function __construct( $controller ) {

        $this->_controller = $controller;

        $this->_getRoute();
        
    }

    private function _getRoute() {
        
        $request = str_replace( sprintf( '?%s', $_SERVER['QUERY_STRING'] ), '',  $_SERVER['REQUEST_URI'] );
        
        $routes = array_filter( 
            explode( 
                '/',
                $request
            )
        );

        $route = array_shift(
            $routes
        );

        $this->_controller->setPage( $route );

    }
    
}
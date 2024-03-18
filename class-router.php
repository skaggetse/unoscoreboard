<?php
/**
 * The web router
 */

class Router {

    private $_controller;

    public function __construct( $controller ) {

        $this->_controller = $controller;

        $this->getRoute();
        
    }

    private function getRoute() {
        $routes = array_filter( 
            explode( 
                '/',
                $_SERVER['REQUEST_URI']
            )
        );

        $route = array_shift(
            $routes
        );

        $this->_controller->setPage( $route );

    }
    
}
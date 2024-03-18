<?php

require __DIR__ . '/vendor/autoload.php';

/**
 * Get the API
 */
require __DIR__ . '/class-model.php';

/**
 * Get the router
 */
require __DIR__ . '/class-router.php';

/**
 * Get the controller
 */
require __DIR__ . '/class-controller.php';

/**
 * Get the view
 */
require __DIR__ . '/class-view.php';

$controller = new Controller ( 'http://unoapi.friikod.se' );

new Router( $controller );
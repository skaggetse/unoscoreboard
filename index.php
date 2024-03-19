<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Get the API
 */
require __DIR__ . '/src/class-model.php';

/**
 * Get the router
 */
require __DIR__ . '/src/class-router.php';

/**
 * Get the controller
 */
require __DIR__ . '/src/class-controller.php';

/**
 * Get the view
 */
require __DIR__ . '/src/class-view.php';

$controller = new Controller ();

new Router( $controller );  
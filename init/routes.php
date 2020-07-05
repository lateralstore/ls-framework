<?php

/*
 * Admin routes
 */

if ( isset( $CONFIG ) && isset( $CONFIG['BACKEND_URL'] ) ) {
	$backend_url = $CONFIG['BACKEND_URL'];
} else {
	$backend_url = '/backend';
}

if ( substr( $backend_url, 0, 1 ) == '/' ) {
	$backend_url = substr( $backend_url, 1 );
}

$route = Phpr::$router->addRule( "backend_file_get/:param1/:param2/:param3/:param4" );
$route->folder( 'modules/backend/controllers' );
$route->controller( 'backend_files' );
$route->action( 'get' );
$route->def( 'param1', null );
$route->def( 'param2', null );
$route->def( 'param3', null );
$route->def( 'param4', null );


/*
 * Simplify url access point for backend sessions / login
 */
$route = Phpr::$router->addRule( $backend_url . "/session/:param1" );
$route->folder( 'modules/backend/controllers' );
$route->controller( 'backend_session' );
$route->def( 'param1', null );
$route->check('param1', '/^$/ ');

$route = Phpr::$router->addRule( $backend_url . "/session/handle/:action/:param1" );
$route->folder( 'modules/backend/controllers' );
$route->controller( 'backend_session' );
$route->def( 'action', 'index' );
$route->def( 'param1', null );





$route = Phpr::$router->addRule( "download_product_file/:param1/:param2/:param3/:param4/:param5" );
$route->def( 'param1', null );
$route->def( 'param2', null );
$route->def( 'param3', null );
$route->def( 'param4', null );
$route->def( 'param5', null );
$route->controller( 'application' );
$route->action( 'download_product_file' );


$route = Phpr::$router->addRule( $backend_url . "/:module/:controller/:action/:param1/:param2/:param3/:param4" );
$route->folder( 'modules/:module/controllers' );
$route->def( 'module', 'backend' );
$route->def( 'controller', 'index' );
$route->def( 'action', 'index' );
$route->def( 'param1', null );
$route->def( 'param2', null );
$route->def( 'param3', null );
$route->def( 'param4', null );
$route->convert( 'controller', '/^.*$/', ':module_$0' );

/*
 * Configuration tool routes
 */

if ( isset( $CONFIG ) && isset( $CONFIG['CONFIG_URL'] ) ) {
	$config_url = $CONFIG['CONFIG_URL'];
} else {
	$config_url = '/config_tool';
}

if ( substr( $config_url, 0, 1 ) == '/' ) {
	$config_url = substr( $config_url, 1 );
}

$route = Phpr::$router->addRule( $config_url . "/:action/:param1/:param2/:param3/:param4" );
$route->folder( 'modules/core/controllers' );
$route->def( 'action', 'index' );
$route->def( 'param1', null );
$route->def( 'param2', null );
$route->def( 'param3', null );
$route->def( 'param4', null );
$route->controller( 'LS_ConfigController' );

/*
 * Default routes
 */

$route = Phpr::$router->addRule( "download_product_file/:param1/:param2/:param3/:param4/:param5" );
$route->def( 'param1', null );
$route->def( 'param2', null );
$route->def( 'param3', null );
$route->def( 'param4', null );
$route->def( 'param5', null );
$route->controller( 'application' );
$route->action( 'download_product_file' );

$route = Phpr::$router->addRule( "backend_theme_styles_hidden_url" );
$route->controller( 'application' );
$route->action( 'backend_theme_styles_hidden_url' );


$route = Phpr::$router->addRule( "/:param1/:param2/:param3/:param4/:param5/:param6" );
$route->def( 'param1', null );
$route->def( 'param2', null );
$route->def( 'param3', null );
$route->def( 'param4', null );
$route->def( 'param5', null );
$route->def( 'param6', null );
$route->controller( 'application' );
$route->action( 'index' );

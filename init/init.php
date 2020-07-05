<?php

if ( !isset( $PHPR_NO_SESSION ) || !$PHPR_NO_SESSION ) {
	// Override CMS security objects
	Phpr::$security          = new Core_Security();
	Phpr::$frontend_security = new Core_FrontEndSecurity();

	// Start session object
	Phpr::$session->start();
}


// Include routing
require_once( 'routes.php' );


/*
 * Send the no-cache headers
 */

header( "Pragma: public" );
header( "Expires: 0" );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: pre-check=0, post-check=0, max-age=0', false );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );

header( "Content-type: text/html; charset=utf-8" );

/*
 * Init multibyte strings encoding
 */

mb_internal_encoding( 'UTF-8' );

$class_loader = isset(Phpr::$classLoader) ? Phpr::$classLoader : Phpr::$class_loader; //legacy support
$class_loader->add_library_directory( PATH_APP . '/modules/shop/currency_converters' );
$class_loader->add_library_directory( PATH_APP . '/modules/shop/price_rule_conditions' );
$class_loader->add_library_directory( PATH_APP . '/modules/shop/price_rule_conditions/base_classes' );
$class_loader->add_library_directory( PATH_APP . '/modules/shop/price_rule_actions' );

/*
 * Other configuration options
 */

ini_set( 'auto_detect_line_endings', true );

if ( !isset( $APP_CONF ) ) {
	$APP_CONF = array();
}

$APP_CONF['UPDATE_SEQUENCE'] = array( 'core', 'system', 'users', 'cms', 'shop' );
$APP_CONF['DB_CONFIG_MODE']  = 'secure';
$APP_CONF['UPDATE_CENTER'] = null;
$APP_CONF['APP_NAME'] = 'LateralStore';
<?php
/*
 * LS BOOT
 */

error_reporting( E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED );
ini_set( 'display_errors', true );

/*
 * This variable contains a path to this file.
 */

$bootstrapPath = __FILE__;

/*
 * Specify the application directory root
 *
 * Leave this variable blank if application root directory matches the site root directory.
 * Otherwise specify an absolute path to the application root, for example:
 * $applicationRoot = realpath( dirname($bootstrapPath)."/../app" );
 *
 */

$applicationRoot = "";

/*
 * Include the configuration script
 */

include 'config/config.php';

if ( isset( $CONFIG['BOOT_INCLUDE'] ) && is_array( $CONFIG['BOOT_INCLUDE'] ) ) {
	foreach ( $CONFIG['BOOT_INCLUDE'] as $inc ) {
		include $inc;
	}
}


/*
 * Detect CLI
 */

function ls_detect_command_line_interface() {
	$sapi = php_sapi_name();

	if ( $sapi == 'cli' ) {
		return true;
	}

	// if (array_key_exists('SHELL', $_SERVER) && strlen($_SERVER['SHELL']))
	// 	return true;

	if ( !array_key_exists( 'DOCUMENT_ROOT', $_SERVER ) || !strlen( $_SERVER['DOCUMENT_ROOT'] ) ) {
		return true;
	}

	return false;
}

/*
 * Detect the CLI update argument
 */

$ls_cli_update_flag  = false;
$ls_cli_force_update = false;
$ls_cli_mode         = ls_detect_command_line_interface();

if ( $ls_cli_mode ) {
	if ( isset( $_SERVER["argv"] ) ) {
		foreach ( $_SERVER["argv"] as $argument ) {
			if ( $argument == '--update' ) {
				$ls_cli_update_flag = true;
			}

			if ( $argument == '--force' ) {
				$ls_cli_force_update = true;
			}
		}
	}
}

if ( $ls_cli_mode ) {
	global $PHPR_NO_SESSION;
	global $Phpr_InitOnly;

	$PHPR_NO_SESSION = true;
	$Phpr_InitOnly   = true;

	$APP_CONF                      = array();
	$APP_CONF['APP_NAME'] = 'LateralStore';
	$APP_CONF['ERROR_LOG_FILE']    = dirname( __FILE__ ) . '/logs/cli_errors.txt';
	$APP_CONF['NO_TRACELOG_CHECK'] = true;
}


//add custom helpers
if ( file_exists( PATH_APP . "/" . "init/custom_helpers.php" ) ) {
	include_once PATH_APP . "/" . "init/custom_helpers.php";
}


/*
 * Boot the PHP Road library
 */
include( "phproad/boot.php" );


if ( $ls_cli_update_flag ) {
	Core_Cli::authenticate();
	Core_UpdateManager::create()->cli_update( $ls_cli_force_update );
}

<?php
/*
 Plugin Name: Paid Memberships Pro - BuddyPress Add On
 Plugin URI: https://wordpress.org/plugins/pmpro-buddypress
 Description: Allow individual BuddyPress functionality to be controlled by PMPro
 Version: 0.1.1a
 Author: strangerstudios, ghmaster
 Author URI: https://www.strangerstudios.com
 */
register_activation_hook( __FILE__, 'pmprobp_install' );
function pmprobp_install() {
	set_transient( 'pmprobp_activated', true, 30 );
}
/*
	includes
*/
define( 'PMPROBP_DIR', dirname( __file__ ) );
require_once( PMPROBP_DIR . '/includes/pmpro-buddypress-settings.php' );
require_once( PMPROBP_DIR . '/includes/membership-level-settings.php' );
require_once( PMPROBP_DIR . '/includes/restrictions.php' );
require_once( PMPROBP_DIR . '/includes/groups.php' );
require_once( PMPROBP_DIR . '/includes/directory.php' );
require_once( PMPROBP_DIR . '/includes/profiles.php' );
require_once( PMPROBP_DIR . '/classes/class-help-welcome-menus.php' );


<?php

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );
/**
 *          $file = __FILE__;
			$line = __LINE__;
			where_is_this_error( $file, $line );
 */
class BP_Navigation {

	public static function init() {
		add_action( 'bp_setup_nav', array( __CLASS__, 'add_pmpro_bp_nav' ), 5 );
	}

	public static function change_settings_subnav() {
		$args = array(
			'parent_slug' => 'pmpro',
			'screen_function' => 'bp_core_screen_notification_settings',
			'subnav_slug' => 'pmpro-stuff',
		);

		bp_core_new_nav_default( $args );
	}

	public static function add_pmpro_bp_nav() {
		global $bp;
		if ( ! empty( $bp ) ) {
			bp_core_new_nav_item(
				array(
					'name' => __( 'PMPro Stuff', 'buddypress' ),
					'slug' => 'pmpro',
					'screen_function' => array( __CLASS__, 'add_tab_screen' ),
					'parent_url'      => bp_loggedin_user_domain() . '/pmpro/',
					'parent_slug'     => $bp->profile->slug,
					'default_subnav_slug' => 'pmpro-levels',
					'position' => 5,
					'show_for_displayed_user' => true,
				)
			);
			bp_core_new_subnav_item(
				array(
					'name'              => __( 'PMPro Levels', 'buddypress' ),
					'slug'              => 'pmpro-levels',
					'parent_url'        => bp_loggedin_user_domain() . '/pmpro/',
					'parent_slug'       => 'pmpro',
					'screen_function'   => array( __CLASS__, 'bp_pmpro_levels_menu' ),
					'position'          => 30,
					'user_has_access'   => bp_is_my_profile(),
				)
			);
			bp_core_new_subnav_item(
				array(
					'name'              => __( 'PMPro Account', 'buddypress' ),
					'slug'              => 'pmpro-account',
					'parent_url'        => bp_loggedin_user_domain() . '/pmpro/',
					'parent_slug'       => 'pmpro',
					'screen_function'   => array( __CLASS__, 'bp_pmpro_account_menu' ),
					'position'          => 30,
					'user_has_access'   => bp_is_my_profile(),
				)
			);
			bp_core_new_subnav_item(
				array(
					'name'              => __( 'PMPro Checkout', 'buddypress' ),
					'slug'              => 'pmpro-checkout',
					'parent_url'        => bp_loggedin_user_domain() . '/pmpro/',
					'parent_slug'       => 'pmpro',
					'screen_function'   => array( __CLASS__, 'bp_pmpro_checkout_menu' ),
					'position'          => 30,
					'user_has_access'   => bp_is_my_profile(),
				)
			);
			bp_core_new_subnav_item(
				array(
					'name'              => __( 'PMPro Profile', 'buddypress' ),
					'slug'              => 'pmpro-profile',
					'parent_url'        => bp_loggedin_user_domain() . '/pmpro/',
					'parent_slug'       => 'pmpro',
					'screen_function'   => array( __CLASS__, 'pmpro_profile_menu' ),
					'position'          => 30,
					'user_has_access'   => bp_is_my_profile(),
				)
			);
		}
	}

	public static function bp_pmpro_levels_menu() {
		add_action( 'bp_template_title', array( __CLASS__, 'bp_pmpro_levels_tab_title' ) );
		add_action( 'bp_template_content', array( __CLASS__, 'bp_pmpro_levels_tab_content' ) );
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	public static function bp_pmpro_levels_tab_title() {
		echo '<h3>Tab Title</h3><h5 class="pbrocks elucidate">Delete this text and edit here ' . basename( __CLASS__ ) . '::' . __FUNCTION__ . ' on line ' . __LINE__ . '</h5>';
	}

	public static function bp_pmpro_levels_tab_content() {
		echo '<h3>Tab Content</h3>' . basename( __FUNCTION__ ) . ' on line ' . __LINE__;
		echo '<p>You can edit the text here in the ' . __FUNCTION__ . ' method of the ' . __CLASS__ . ' on line ' . __LINE__ . '. There is a separate method for editing the title.</p>';
		echo do_shortcode( '[pmpro_levels]' );
	}


	public static function bp_pmpro_account_menu() {
		add_action( 'bp_template_title', array( __CLASS__, 'bp_pmpro_account_title' ) );
		add_action( 'bp_template_content', array( __CLASS__, 'bp_pmpro_account_content' ) );
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	public static function bp_pmpro_account_title() {
		echo '<h3>Tab Title</h3><h5 class="pbrocks elucidate">Delete this text and edit here' . basename( __CLASS__ ) . '::' . __FUNCTION__ . ' on line ' . __LINE__ . '</h5>';
	}

	public static function bp_pmpro_account_content() {
		echo '<h3>Tab Content</h3>' . basename( __FUNCTION__ ) . ' on line ' . __LINE__;
		echo '<p>You can edit the text here in the ' . __FUNCTION__ . ' method of the ' . __CLASS__ . ' on line ' . __LINE__ . '. There is a separate method for editing the title.</p>';
		echo do_shortcode( '[pmpro_account]' );
	}

	public static function bp_pmpro_checkout_menu() {
		add_action( 'bp_template_title', array( __CLASS__, 'bp_pmpro_checkout_title' ) );
		add_action( 'bp_template_content', array( __CLASS__, 'bp_pmpro_checkout_content' ) );
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	public static function bp_pmpro_checkout_title() {
		echo '<h3>Tab Title</h3><h5 class="pbrocks elucidate">Delete this text and edit here' . basename( __CLASS__ ) . '::' . __FUNCTION__ . ' on line ' . __LINE__ . '</h5>';
	}

	public static function bp_pmpro_checkout_content() {
		echo '<h3>Tab Content</h3>' . basename( __FUNCTION__ ) . ' on line ' . __LINE__;
		echo '<p>You can edit the text here in the ' . __FUNCTION__ . ' method of the ' . __CLASS__ . ' on line ' . __LINE__ . '. There is a separate method for editing the title.</p>';
		echo do_shortcode( '[pmpro_checkout]' );
	}

	public static function pmpro_profile_menu() {
		add_action( 'bp_template_title', array( __CLASS__, 'pmpro_profile_tab_title' ) );
		add_action( 'bp_template_content', array( __CLASS__, 'pmpro_profile_tab_content' ) );
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	public static function pmpro_profile_tab_title() {
		echo '<h3>Tab Title</h3><h5 class="pbrocks elucidate">Delete this text and edit here ' . basename( __CLASS__ ) . '::' . __FUNCTION__ . ' on line ' . __LINE__ . '</h5>';
	}

	public static function pmpro_profile_tab_content() {
		echo '<h3>Tab Content</h3>' . basename( __FUNCTION__ ) . ' on line ' . __LINE__;
		echo '<p>You can edit the text here in the ' . __FUNCTION__ . ' method of the ' . __CLASS__ . ' on line ' . __LINE__ . '. There is a separate method for editing the title.</p>';
		echo do_shortcode( '[pmpro_levels]' );
	}

	public static function class_info() {
		return '<h3>Class = ' . __CLASS__ . '<br>File = ' . basename( __FILE__ ) . ' &nbsp; Function = ' . __FUNCTION__ . '</h3><h3>' . __FILE__ . '</h3>';
	}
}
BP_Navigation::init();

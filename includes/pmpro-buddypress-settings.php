<?php
/**
 * Code to create a Memberships -> BuddyPress page with settings.
 */
function pmpro_bp_add_on_stuff() {
	$pmprobp_stuff['name'] = 'PMPro BuddyPress';
	$pmprobp_stuff['slug'] = 'pmpro-buddypress';

	return $pmprobp_stuff;
}
function pmpro_bp_extra_page_settings( $pages ) {
	$pages['pmprobp_restricted'] = array(
		'title' => 'Access Restricted',
		'content' => '[pmpro_buddypress_restricted]',
		'hint' => 'Include the shortcode [pmpro_buddypress_restricted].',
	);
	return $pages;
}
add_action( 'pmpro_extra_page_settings', 'pmpro_bp_extra_page_settings', 10, 1 );

add_action( 'admin_menu', 'pmpro_bp_add_admin_menu_page' );
function pmpro_bp_add_admin_menu_page() {
	$pmprobp_stuff = pmpro_bp_add_on_stuff();
	$pmpro_bp_help = add_submenu_page( 'pmpro-membershiplevels', __( $pmprobp_stuff['name'], 'pmpro' ), __( $pmprobp_stuff['name'], 'pmpro' ), 'manage_options', $pmprobp_stuff['slug'], 'pmpro_bp_buddpress_admin_page' );
	// Adds pmpro_bp_help_tab when pmpro_bp_help loads
	add_action( 'load-' . $pmpro_bp_help, 'pmpro_add_bp_help_tab' );
}

function pmpro_add_bp_help_tab() {
	$pmprobp_stuff = pmpro_bp_add_on_stuff();
	$screen = get_current_screen();

	// Add pmpro_bp_help_tab if current screen is My Admin Page
	$screen->add_help_tab(
		array(
			'id'    => $pmprobp_stuff . '_help_1',
			'title' => __( 'Tab 1 - Choose Registration Page' ),
			'content'   => '<h4>' . __( 'Update BuddyPress Profile with Additional User Information from Registration' ) . '</h4><p>' . __( 'Descriptive content that will show in PMPro BP Help Tab-body goes here.' ) . '</p>',
		)
	);
	$screen->add_help_tab(
		array(
			'id'    => $pmprobp_stuff . '_help_2',

			'title' => __( 'Tab 2 - Register Helper Import' ),
			'content'   => '<h4>' . __( 'Import Register Helper fields to BuddyPress xProfile with Additional User Information from Registration' ) . '</h4><p>' . __( '<a href="//www.paidmembershipspro.com/update-buddypress-profile-additional-user-information-registration/" target="_blank">Update the user’s BuddyPress Extended Profile</a> with additional fields collected at Membership Registration, such as Company. By default, only the user’s email address, first and last name are added to the xprofile/BuddyPress user meta.</p><p><a href="https://gist.github.com/strangerstudios/3e1d1b5ec1aa1a090a73#file-pmprobuddy_update_user_meta-php" target="_blank">gist</a> This bit of code updates or adds additional Extended Profile (xprofile) fields, allowing you to create a more personalized/customized BuddyPress profile.' ) . '</p>',
		)
	);
	$screen->add_help_tab(
		array(
			'id'    => $pmprobp_stuff . '_help_3',
			'title' => __( 'Tab 3 - Level on BP Profile?' ),
			'content'   => '<h4>' . __( 'Choose to Show Level on BuddyPress Profile with Additional User Information from Registration' ) . '</h4><p>' . __( 'Descriptive content that will show in PMPro BP Help Tab-body goes here.' ) . '</p>',
		)
	);
	$screen->add_help_tab(
		array(
			'id'    => $pmprobp_stuff . '_help_4',
			'title' => __( 'Tab 4 - Lockdown BP' ),
			'content'   => '<h4>' . __( 'Do you want to Lockdown BuddyPress?' ) . '</h4><p>' . __( 'Descriptive content to Lockdown BuddyPress that will show in PMPro BP Help Tab-body goes here.' ) . '</p>',
		)
	);
	$screen->add_help_tab(
		array(
			'id'    => $pmprobp_stuff . '_help_5',
			'title' => __( 'Tab 5 - BP Groups' ),
			'content'   => '<h4>' . __( 'PMPro and BuddyPress Groups' ) . '</h4><p>' . __( 'Descriptive content about PMPro and BuddyPress Groups that will show in PMPro BP Help Tab-body goes here.' ) . '</p>',
		)
	);
}

// redirect the Register button from wp-login.php
function pmpro_bp_registration_pmpro_to_bp_redirect( $url ) {
	$bp_pages = get_option( 'bp-pages' );

	$pmpro_bp_register = get_option( 'pmpro_bp_registration_page' );
	if ( ! empty( $pmpro_bp_register ) && $pmpro_bp_register == 'buddypress' ) {
		$url = get_permalink( $bp_pages['register'] );
	}

	return $url;
}

// add_filter( 'pmpro_register_redirect', 'pmpro_bp_registration_pmpro_to_bp_redirect' );
function pmpro_bp_buddpress_admin_page() {
		// get/set settings
	if ( ! empty( $_REQUEST['savesettings'] ) ) {
		update_option( 'pmpro_bp_registration_page', $_POST['pmpro_bp_register'] );
		update_option( 'pmpro_bp_show_level_on_bp_profile', $_POST['pmpro_bp_level_profile'], 'no' );
		if ( is_multisite() ) {
			update_option( 'pmpro_bp_multisite_redirect_target', $_POST['pmpro_bp_multisite_redirect'], 'activity' );
		}
	}

	$pmpro_bp_register = get_option( 'pmpro_bp_registration_page' );
	$pmpro_bp_level_profile = get_option( 'pmpro_bp_show_level_on_bp_profile' );
	$pmpro_bp_multisite_redirect = get_option( 'pmpro_bp_multisite_redirect_target' );

	if ( empty( $pmpro_bp_register ) ) {
		$pmpro_bp_register = 'pmpro'; // default to the PMPro Levels page
	}

	if ( empty( $pmpro_bp_level_profile ) ) {
		$pmpro_bp_level_profile = 'yes';
	} // default to showing Level on BuddyPress Profile

	if ( empty( $pmpro_bp_multisite_redirect ) ) {
		$pmpro_bp_multisite_redirect = 'profile';
	} // default to showing Level on BuddyPress Profile ?>
	<div class="wrap">
	<h2>PMPro BuddyPress Settings</h2>
		<form action="" method="post" enctype="multipart/form-data">
		
		<table class="form-table">
		<tbody>
			<tr>
				<th scope="row" valign="top">
					<label for="pmpro_bp_register"><?php _e( 'Registration Page', 'pmpro' ); ?></label>
				</th>
				<td>
					<select id="pmpro_bp_register" name="pmpro_bp_register">
						<option value="pmpro" 
						<?php
						if ( $pmpro_bp_register == 'pmpro' ) {
?>
selected="selected"<?php } ?>><?php _e( 'Use PMPro Levels Page', 'pmpro' ); ?></option>
						<option value="buddypress" 
						<?php
						if ( $pmpro_bp_register == 'buddypress' ) {
?>
selected="selected"<?php } ?>><?php _e( 'Use BuddyPress Registration Page', 'pmpro' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">
					<label for="pmpro_bp_level_profile"><?php _e( 'Show Membership Level on BuddyPress Profile?', 'pmpro' ); ?></label>
				</th>
				<td>
					<select id="pmpro_bp_level_profile" name="pmpro_bp_level_profile">
						<option value="yes" 
						<?php
						if ( $pmpro_bp_level_profile == 'yes' ) {
?>
selected="selected"<?php } ?>><?php _e( 'Yes', 'pmpro' ); ?></option>
						<option value="no" 
						<?php
						if ( $pmpro_bp_level_profile == 'no' ) {
?>
selected="selected"<?php } ?>><?php _e( 'No', 'pmpro' ); ?></option>
					</select>
				</td>
			</tr>
			<?php if ( is_multisite() ) : ?>
			<tr>
				<th scope="row" valign="top">
					<label for="pmpro_bp_multisite_redirect"><?php _e( 'Multisite Redirect', 'pmpro' ); ?></label>
				</th>
				<td>
					<select id="pmpro_bp_multisite_redirect" name="pmpro_bp_multisite_redirect">
						<option value="activity" 
						<?php
						if ( $pmpro_bp_multisite_redirect == 'activity' ) {
?>
selected="selected"<?php } ?>><?php _e( 'Activity Stream', 'pmpro' ); ?></option>
						<option value="profile" 
						<?php
						if ( $pmpro_bp_multisite_redirect == 'profile' ) {
?>
selected="selected"<?php } ?>><?php _e( 'Profile', 'pmpro' ); ?></option>
						<option value="subsite" 
						<?php
						if ( $pmpro_bp_multisite_redirect == 'subsite' ) {
?>
selected="selected"<?php } ?>><?php _e( 'Subsite Homepage', 'pmpro' ); ?></option>
						<option value="main-site" 
						<?php
						if ( $pmpro_bp_multisite_redirect == 'main-site' ) {
?>
selected="selected"<?php } ?>><?php _e( 'Main Site Homepage', 'pmpro' ); ?></option>
					</select>
					<?php
					if ( $pmpro_bp_multisite_redirect ) {
						echo '<h4>' . $pmpro_bp_multisite_redirect . '</h4>';
					}
					?>

				 </td>
			</tr>
		<?php endif; ?>		
	</tbody>
	</table>

	<p class="submit">
		<input name="savesettings" type="submit" class="button button-primary" value="<?php _e( 'Save Settings', 'pmpro' ); ?>" />
	</p>
</form>
</div>
<?php
}
function pmprobuddy_update_user_meta( $meta_id, $object_id, $meta_key, $meta_value ) {
	// make sure buddypress is loaded
	do_action( 'bp_init' );

	/**
	 * In order to import the Register Helper fields to xProfile fields,
	 * we'll need to create an array using the usermeta key from Register Helper and the label/name of the BuddyPress xProfile.
	 *
	 * @var array
	 */
	$um = array(
		// RH usermeta field => BuddyPress Profile field name
		'company' => 'Company',
	);

	// check if this usermeta is to be imported
	foreach ( $um as $left => $right ) {
		if ( $meta_key == $left ) {
			// find the buddypress field
			$field = xprofile_get_field_id_from_name( $right );

			// update it
			if ( ! empty( $field ) ) {
				xprofile_set_field_data( $field, $object_id, $meta_value );
			}
		}
	}
}
add_action( 'update_user_meta', 'pmprobuddy_update_user_meta', 10, 4 );

/**
 * Need to add the meta_id for add filter
 *
 * @param  [type] $object_id  [description]
 * @param  [type] $meta_key   [description]
 * @param  [type] $meta_value [description]
 * @return [type]             [description]
 */
function pmprobuddy_add_user_meta( $object_id, $meta_key, $meta_value ) {
	pmprobuddy_update_user_meta( null, $object_id, $meta_key, $meta_value );
}
add_action( 'add_user_meta', 'pmprobuddy_add_user_meta', 10, 3 );

<?php
/*
Plugin Name: PMPro Customizations
Plugin URI: http://www.paidmembershipspro.com/wp/pmpro-customizations/
Description: Customizations for Paid Memberships Pro
Version: .2
Author: Stranger Studios
Author URI: http://www.strangerstudios.com
*/

function my_pmprorh_init() {
	// don't break if Register Helper is not loaded
	if ( ! function_exists( 'pmprorh_add_registration_field' ) ) {
		return false;
	}

	// define the fields
	$fields = array();
	$fields[] = new PMProRH_Field(
		'name', // input name, will also be used as meta key
		'text', // type of field
		array(
			'label' => 'Name',    // label
			'size' => 40, // input size
			'class' => 'name pmpro-custom-field', // custom class
			'profile' => true, // show in user profile
			'required' => true, // make this field required
		)
	);
	$fields[] = new PMProRH_Field(
		'gender', // input name, will also be used as meta key
		'select', // type of field
		array(
			'label' => 'Gender',    // label
			'options' => array(
				'' => '—-', // blank option – cannot be selected if this field is required
				'Male' => 'Male', // <option value="male">Male</option>
				'Female' => 'Female', // <option value="female">Female</option>
			),
			'profile' => true, // show in user profile
			'class' => 'company pmpro-custom-field', // add a class
			'required' => true, // make this field required
		)
	);
	$fields[] = new PMProRH_Field(
		'country', // input name, will also be used as meta key
		'select', // type of field
		array(
			'label' => 'Country',    // label
			'options' => array(
				'Abkhazia' => 'Abkhazia',
				'Afghanistan' => 'Afghanistan',
				'Aland' => 'Aland',
				'Albania' => 'Albania',
			),
			'profile' => true, // show in user profile
			'class' => 'company pmpro-custom-field', // add a class
			'required' => true, // make this field required
		)
	);

	// add the fields into after email position on checkout page
	foreach ( $fields as $field ) {
		pmprorh_add_registration_field(
			'after_email', // location on checkout page
			$field // PMProRH_Field object
		);
	}

	// that's it. see the PMPro Register Helper readme for more information and examples.
}

add_action( 'init', 'my_pmprorh_init' );

/*
Sync PMPro fields to BuddyPress profile fields.
*/
function pmprobuddy_update_user_meta( $meta_id, $object_id, $meta_key, $meta_value ) {
	// make sure buddypress is loaded
	if ( ! defined( 'BP_VERSION' ) ) {
		return;
	}

	// array of user meta to mirror
	$um = array(
		'name' => 'Name',
		'gender' => 'Gender',
		'country' => 'Country',    // usermeta field => buddypress profile field
	);

	// check if this user meta is to be mirrored
	foreach ( $um as $umeta_field => $bp_field ) {
		if ( $meta_key == $umeta_field ) {
			// find the buddypress field
			$field = xprofile_get_field_id_from_name( $bp_field );

			// update it
			if ( ! empty( $field ) ) {
				xprofile_set_field_data( $field, $object_id, $meta_value );
			}
		}
	}
}

add_action( 'updated_user_meta', 'pmprobuddy_update_user_meta', 10, 4 );
add_action( 'added_user_meta', 'pmprobuddy_update_user_meta', 10, 4 );


/*
 * // need to add the meta_id for add filter
function pmprobuddy_add_user_meta($meta_id = null, $object_id, $meta_key, $meta_value)
{
	pmprobuddy_update_user_meta($meta_id, $object_id, $meta_key, $meta_value);
}
*/

// adds user to level when they sign up via register page
function my_user_register( $user_id ) {
	if ( function_exists( 'pmpro_changeMembershipLevel' ) ) {
		pmpro_changeMembershipLevel( 2, $user_id );
	}
}

add_action( 'user_register', 'my_user_register' );

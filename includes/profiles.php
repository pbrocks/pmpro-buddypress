<?php
/*
	Code to sync profile fields to PMPro Register Helper or edit profiles in general.
*/

/**
 * See if the meta field is in the RH defined fields
 * and has the BuddyPress property set. If so,
 * update the xprofile field.
 */
function pmpro_bp_update_user_meta( $meta_id, $user_id, $meta_key, $meta_value ) {
	global $pmprorh_registration_fields, $current_user;
	if ( empty( $pmprorh_registration_fields ) ) {
		return;
	}

	foreach ( $pmprorh_registration_fields as $field_location ) {
		foreach ( $field_location as $rh_field ) {
			if ( $rh_field->meta_key == $meta_key && ! empty( $rh_field->buddypress ) ) {

				// switch for type
				$x_field = xprofile_get_field_id_from_name( $rh_field->buddypress );

				if ( ! empty( $x_field ) ) {
					$maybe_serialized = maybe_serialize( $meta_value );
					xprofile_set_field_data( $x_field, $user_id, $meta_value );
					set_transient( $meta_key . '_testing_pbrx_' . $current_user->user_login, $meta_value, 12 * HOUR_IN_SECONDS );
				}
			}
		}
	}
}
add_action( 'update_user_meta', 'pmpro_bp_update_user_meta', 10, 4 );

/**
 * Use our filter above when user meta is added as well.
 */
function pmpro_bp_add_user_meta( $user_id, $meta_key, $meta_value ) {
	pmpro_bp_update_user_meta( null, $user_id, $meta_key, $meta_value );
}
add_action( 'add_user_meta', 'pmpro_bp_add_user_meta', 10, 3 );

/**
 * When xprofile is updated, see if we need to update user meta.
 */
function pmpro_bp_xprofile_updated_profile( $user_id, $posted_field_ids, $errors, $old_values, $new_values ) {
	global $pmprorh_registration_fields;
	if ( empty( $pmprorh_registration_fields ) ) {
		return;
	}

	if ( empty( $errors ) ) {
		foreach ( $posted_field_ids as $xprofile_field_id ) {
			$xprofile_field = new BP_XProfile_Field( $xprofile_field_id );
			echo $xprofile_field->name;

			foreach ( $pmprorh_registration_fields as $field_location ) {
				foreach ( $field_location as $rh_field ) {
					if ( ! empty( $rh_field->buddypress ) && $rh_field->buddypress == $xprofile_field->name ) {
						// switch for type?
						update_user_meta( $user_id, $rh_field->meta_key, $new_values[ $xprofile_field_id ]['value'] );
					}
				}
			}
		}
	}
}
add_action( 'xprofile_updated_profile', 'pmpro_bp_xprofile_updated_profile', 1, 5 );

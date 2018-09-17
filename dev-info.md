# buddypress-sync

[] Find recipe for updating other when saving

	[] WP => BP
	[x] BP => WP
		- Created Shortcode to see WP and WP side by side
		- Successfully updating single spoonfed field<br>

### Useful functions

- `xprofile_set_field_data( $x_field, $user_id, $meta_value );`

- `xprofile_get_field_data( $x_field, $user_id, $multi_format );`
	- `$multi_format` choice between 'comma', which delivers comma-separated string, and 'array', which delivers array
	- important to specify `$multi_format`

### Open and close code block with 3 backticks on their own line; opening line should also have the language specified
```php
function run_when_saving_x_profile( $field, $bp_field, $user_id, $meta_value ) {
	global $bp;
	$multi_format = 'array';
	$x_field = xprofile_get_field_id_from_name( $bp_field );
	$bp_array = xprofile_get_field_data( $x_field, $user_id, $multi_format );
	update_user_meta( $user_id, $field, $bp_array, $prev_value = '' );
}
```

[] Build function recipe for updating other when saving

[] Expand to run for all fields for updating other when saving

# BuddyPress Sync Notes
[x] WP values not present in Dashboard Profile
	[ ] TML shows Multiselect on frontend
	[ ] Register Helper need to adjust Multiselect presentation?
		- Multiselect displays in profile when saved in profile
		- but not when programmatically set during xProfile save

[ ]WP stored as array, BP serialized string?

BuddyPress and WordPress appear to store their arrays similarly, but not exact, and render differently

WP Usermeta `a:4:{i:0;s:4:"5'7"";i:1;s:4:"5'8"";i:2;s:4:"5'9"";i:3;s:5:"5'10"";}`

BP xProfile `
a:4:{i:0;s:6:"5\'7\"";i:1;s:6:"5\'8\"";i:2;s:6:"5\'9\"";i:3;s:7:"5\'10\"";}`

https://buddypress.org/support/topic/xprofile-get-field-data-checkbox-returns-array/#post-166620
just fyi: the data is not stored in an array.
It is stored as a serialized string.
Depending on the multi_format value, that string can be returned as an array (and handled in a loop) or as a csv string.

boone was kind enough to add the multi_format var awhile back so that we don’t always need to check type on the returned value in customized displays.

<?php if ( $sectors = xprofile_get_field_data( 'Specialist Sectors', get_the_author_id() ) ) { ?>
		<?php foreach ( $sectors as $sector ) { ?>
			<?php echo $sector; ?>
		<?php } ?>
<?php } ?>

<code>
$args = array(
    'field'     => 'Field Name',
    'user_id'   => 1
);
bp_profile_field_data( $args );
</code>

usermeta	a:3:{i:0;s:6:"5'8″";i:1;s:6:"5'9″";i:2;s:7:"5'10″";}
a:4:{i:0;s:17:"Less than 4\'10\"";i:1;s:7:"4\'10\"";i:2;s:7:"4\'11\"";i:3;s:3:"5\'";}

# Errors

(https://buddypress.pmpro.work/members/pbrocks/profile/)[https://buddypress.pmpro.work/members/pbrocks/profile/]
<a href="https://buddypress.pmpro.work/members/pbrocks/profile/">https://buddypress.pmpro.work/members/pbrocks/profile/</a>
- Notice: Undefined index: pmpro_bp_group_automatic_add in /home/pmpro/public_html/buddypress/wp-content/plugins/pmpro-buddypress/includes/common.php on line 110

- Notice: Undefined index: pmpro_bp_group_can_request_invite in /home/pmpro/public_html/buddypress/wp-content/plugins/pmpro-buddypress/includes/common.php on line 113

- Notice: Undefined index: pmpro_bp_member_types in /home/pmpro/public_html/buddypress/wp-content/plugins/pmpro-buddypress/includes/common.php on line 116

<a href="https://buddypress.pmpro.work/wp-admin/admin.php?page=pmpro-membershiplevels&edit=1">https://buddypress.pmpro.work/wp-admin/admin.php?page=pmpro-membershiplevels&edit=1</a>
Notice: Undefined index: pmpro_bp_group_automatic_add in /home/pmpro/public_html/buddypress/wp-content/plugins/pmpro-buddypress/includes/membership-level-settings.php on line 14

Notice: Undefined index: pmpro_bp_group_can_request_invite in /home/pmpro/public_html/buddypress/wp-content/plugins/pmpro-buddypress/includes/membership-level-settings.php on line 15

Notice: Undefined index: pmpro_bp_member_types in /home/pmpro/public_html/buddypress/wp-content/plugins/pmpro-buddypress/includes/membership-level-settings.php on line 16
dev-info.md

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

usermeta	a:3:{i:0;s:6:"5'8″";i:1;s:6:"5'9″";i:2;s:7:"5'10″";}
a:4:{i:0;s:17:"Less than 4\'10\"";i:1;s:7:"4\'10\"";i:2;s:7:"4\'11\"";i:3;s:3:"5\'";}
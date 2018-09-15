dev-info.md

https://buddypress.org/support/topic/xprofile-get-field-data-checkbox-returns-array/#post-166620
just fyi: the data is not stored in an array.
It is stored as a serialized string.
Depending on the multi_format value, that string can be returned as an array (and handled in a loop) or as a csv string.

boone was kind enough to add the multi_format var awhile back so that we don’t always need to check type on the returned value in customized displays.

## php code
```php
<?php if ( $sectors = xprofile_get_field_data( 'Specialist Sectors', get_the_author_id() ) ) { ?>
		<?php foreach ( $sectors as $sector ) { ?>
			<?php echo $sector; ?>
		<?php } ?>
<?php } ?>
```

# Checkbox test

* [ ] unchecked # [checkbox:unchecked]
* [x] checked   # [checkbox:checked]
* [X] checked   # [checkbox:checked]
* .
* [ ]          # [checkbox:unchecked]
* [-]          # '[-]'
* [o]          # '[o]'
* [O]          # '[O]'
* .
* \[ ]         # [checkbox:unchecked]
* /[ ]         # '/[ ]'
- \\[ ]        # '\[ ]'
- \[-]         # '\[-]' 
- \[o]         # `\[o]'
- \[x]         # [checkbox:checked]
- \[X]         # [checkbox:checked]
- .
- \\[ ]        # '\[ ]'
- \\[x]        # '\[x]'
- .
- [[ ]]        # ''
- [[x]]        # [link]
- [[o]]        # [link]
- .
- ][ ]         # '][ ]'
- ][x]         # '][x]'
- .
- ] [          #  '] ['
- ]x[          #  ']x['
- .
- .[ ]         #  '.[ ]'
- .[x]         #  '.[x]'
- .1.
- .2.
- .3.
- 1.
- .
- 2.
- 3.
- .
- 96.
-
- .
- [[[ ]        # '[[[ ]'
- [[[x]        # '[[[x]'
.
- [X (YYYY-MM-DD HH:MM:SS)]   # [X (YYYY-MM-DD HH:MM:SS)]

Warning: count(): Parameter must be an array or an object that implements Countable in /app/public/wp-content/plugins/paid-memberships-pro/pages/checkout.php on line 35

Stack Trace
1. {main}() /app/public/index.php:0
2. require() /app/public/index.php:17
3. require_once() /app/public/wp-blog-header.php:19
4. include() /app/public/wp-includes/template-loader.php:74
5. the_content() /app/public/wp-content/themes/kleo/buddypress.php:183
6. apply_filters() /app/public/wp-includes/post-template.php:240
7. WP_Hook->apply_filters() /app/public/wp-includes/plugin.php:203
8. bp_replace_the_content() /app/public/wp-includes/class-wp-hook.php:286
9. apply_filters() /app/public/wp-content/plugins/buddypress/bp-core/bp-core-theme-compatibility.php:761
10. WP_Hook->apply_filters() /app/public/wp-includes/plugin.php:203
11. BP_Members_Theme_Compat->single_dummy_content() /app/public/wp-includes/class-wp-hook.php:286
12. bp_buffer_template_part() /app/public/wp-content/plugins/buddypress/bp-members/classes/class-bp-members-theme-compat.php:212
13. bp_get_template_part() /app/public/wp-content/plugins/buddypress/bp-core/bp-core-template-loader.php:338
14. bp_locate_template() /app/public/wp-content/plugins/buddypress/bp-core/bp-core-template-loader.php:61
15. load_template() /app/public/wp-content/plugins/buddypress/bp-core/bp-core-template-loader.php:155
16. require() /app/public/wp-includes/template.php:690
17. bp_get_template_part() /app/public/wp-content/themes/kleo-child/buddypress/members/single/home.php:111
18. bp_locate_template() /app/public/wp-content/plugins/buddypress/bp-core/bp-core-template-loader.php:61
19. load_template() /app/public/wp-content/plugins/buddypress/bp-core/bp-core-template-loader.php:155
20. require() /app/public/wp-includes/template.php:690
21. do_action() /app/public/wp-content/plugins/buddypress/bp-templates/bp-legacy/buddypress/members/single/plugins.php:58
22. WP_Hook->do_action() /app/public/wp-includes/plugin.php:453
23. WP_Hook->apply_filters() /app/public/wp-includes/class-wp-hook.php:310
24. PMPro_Helpers\inc\classes\PMPro_BuddyPress_Debug::bp_pmpro_checkout_content() /app/public/wp-includes/class-wp-hook.php:286
25. do_shortcode() /app/public/wp-content/plugins/pmpro-helpers/inc/classes/class-pmpro-buddypress-debug.php:286
26. preg_replace_callback() /app/public/wp-includes/shortcodes.php:197
27. do_shortcode_tag() /app/public/wp-includes/shortcodes.php:197
28. pmpro_checkout_shortcode_custom() /app/public/wp-includes/shortcodes.php:319
29. include() /app/public/wp-content/themes/kleo/lib/plugin-pmpro/config.php:452

![Alt text](https://monosnap.com/image/XeWmsSbpr2rEKTXMOCnhYW6wG4jjel.png)


usermeta	a:3:{i:0;s:6:"5'8″";i:1;s:6:"5'9″";i:2;s:7:"5'10″";}
a:4:{i:0;s:17:"Less than 4\'10\"";i:1;s:7:"4\'10\"";i:2;s:7:"4\'11\"";i:3;s:3:"5\'";}
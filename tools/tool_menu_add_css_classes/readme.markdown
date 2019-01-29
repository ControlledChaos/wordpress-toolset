[back to overview](../../README.markdown#initial-functionality)

Tool tool_menu_add_css_classes
===============================

This tool adds CSS classe to a menu item by rules. You can filter by posttype and / or functions like `is_single()`.

````php
	$GLOBALS['toolset'] = array(
		'inits' => array(
			'tool_menu_add_css_classes' => array(
				array(
					'menu_item_id' => {id of menu item},
					'menu_item_object_id' => {id of a page or post},
					'menu_item_object_id_by_acf_field' => array( 'fieldname', 'option/post_id' ),
					'is_posttype' => '{posttype name}',
					'rules' => array(
						array( 'is_single', 'not_attachment' ),
						array( 'is_category' ),
						array( 'is_page_template', array( 'my-template.php', 'another-template.php' ) ),
						array( '$post->ID === 8' ), // must contain "$post->"
						/*
							is equal to:
							if (
								( is_single() && ! is_attachment() )
								|| is_category()
								|| is_page_template( array( 'my-template.php', 'another-template.php' )
								|| $post->ID === 8
							) {
						*/
					),
					'class' => 'current-menu-item',
				),
				array(
					// another rule
				),
			),
		),
	);
````

[back to overview](../../README.markdown#initial-functionality)

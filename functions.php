<?php

	if ( file_exists( get_template_directory() . '/config/config.php' ) ) {

		require_once( get_template_directory() . '/config/config.php' );
	}

	require_once( 'classes.php' );

	// CORE {

	    // GLOBALS['toolglobal'] ( Version 1 ) {

			/** ABOUT

				global storage of requests made inside of tool_ functions
				prevents multiple requests within these functions

				INDEX {

					$GLOBALS['toolglobal']['menus'][ {menu-id, number} ] = object;
						USED IN {
							tool_get_menu_ancestors();
							tool_has_menu_ancestors();
						}
				}
			**/

			$GLOBALS['toolglobal'] = array();

		// }

		// FUNCTIONS { 

			// AUTOLOAD ( Version 1 ) {

				function toolset_autoload( $p ) {

					// SETUP {

					    $d = array(
							'files' => false, // array( '','' )
						);

						$p = array_replace_recursive( $d, $p );

					// }

					foreach ( $p['files'] as $file ) {

						// SANITIZE
						$file = str_replace( '../', '', $file );

						// IF NOT LOADET JET
						if ( ! isset( $GLOBALS['theme']['autoloaded'][ $file ] ) ) {

							include( 'tools/' . $file );
							$GLOBALS['theme']['autoloaded'][ $file ] = true;
						}
					}

				}

			// }

			// CALL THEMEFUNC  ( Version 1 ) {

				// use this functione for calling a function, it will autoload from folder "functions"

				function tool( $p ) {

					// SETUP {

					    // DEFAULTS
						$d = array(
							'name' => false,
							'param' => array(),
						);

						// EXTEND PARAMETER
					    $p = array_replace_recursive( $d, $p );

						// VARIABLES
						$v = array(
							'funame' => false,
							'file' => false,
						);

						// RETURN
						$r = false;

					// }

					if ( $p['name'] ) {

						if ( ! isset( $GLOBALS['tool']['functions'] ) ) {

							include( 'tools/index.php' );
						}

						$v['funame'] = $GLOBALS['tool']['functions'][ $p['name'] ]['funame'];
						$v['file'] = $GLOBALS['tool']['functions'][ $p['name'] ]['dir'];

						if ( ! function_exists( $v['funame'] ) ) {

							toolset_autoload( array(
								'files' => array( $v['file'] . '/index.php' ),
							) );
						}

						$r = $v['funame']( $p['param'] );
					}

					return $r;
				}

			// }

		// }

		// PROZESS {

			// LOAD INITS {

				if ( isset( $GLOBALS['theme']['inits'] ) ) {

					foreach ( $GLOBALS['theme']['inits'] as $key => $value ) {

						if ( $value ) {

							toolset_autoload( array(
								'files' => array( $key . '/index.php' ),
							) );
						}
					}
				}

			// }

			// AUTOLOAD PHP CLASSES ( Version 2 ) {

				/* Info: http://php.net/manual/de/language.oop5.autoload.php */

				function __autoload( $class_name ) {

					if ( isset( $GLOBALS['theme']['autoload_php_classes'] ) ) {

						foreach ( $GLOBALS['theme']['autoload_php_classes'] as $key => $value ) {

							if ( $class_name == $key ) {

								if ( strpos( $value, 'tools/' ) ) {

									$path = $value;
								}

								else {

									$path = get_template_directory() . $value;
								}

								require_once( $value );
							}

						}
					}
				}

			// }

		// }

	// }

?>
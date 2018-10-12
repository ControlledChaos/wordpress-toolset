<?php

	if ( ! empty( $GLOBALS['toolset']['inits']['tool_rest_api']['disable_for_public'] ) ) {

		// REMOVES REST-API FOR FRONTEND, GUTENBERG REQUIRES REST-API {

			if (
				! is_user_logged_in() AND // enables API for logged in users
				! is_admin()
			) {
				add_filter( 'rest_enabled', '_return_false' );
				add_filter( 'rest_jsonp_enabled', '_return_false' );
			}

		// }
	}

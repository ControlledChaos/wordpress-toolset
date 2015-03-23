<?php

	// COMMENT MODERATION RECIPIENTS ( Version 1 ) {

		add_filter( 'comment_moderation_recipients', function( $emails, $comment_id ) {

			$emails = array_flip($emails);

			// REMOVE EMAILS
			if (
				isset( $GLOBALS['toolset']['inits']['tool_wp_comment_moderation_recipients']['emails_remove'] )
				AND count( $GLOBALS['toolset']['inits']['tool_wp_comment_moderation_recipients']['emails_remove'] ) > 1
			) {

				unset( $emails['mail@johannheyne.de'] );
			}

			// ADD EMAILS
			if (
				isset( $GLOBALS['toolset']['inits']['tool_wp_comment_moderation_recipients']['emails_add'] )
				AND count( $GLOBALS['toolset']['inits']['tool_wp_comment_moderation_recipients']['emails_add'] ) > 1
			) {

				foreach ( $GLOBALS['toolset']['inits']['tool_wp_comment_moderation_recipients']['emails_add'] as $item ) {

					$emails[ $item ];
				}
			}

			$emails = array_flip($emails);

			return $emails;

		}, 10, 2 );

	// }

?>
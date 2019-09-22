<?php

function _themename_handle_delete_post() {
	if ( isset($_GET['action']) && $_GET['action'] === '_themename_delete_post' ) {
		// Checking nonce, generated hash
		if ( !isset($_GET['nonce']) || !wp_verify_nonce( $_GET['nonce'], '_themename_delete_post_' . $_GET['post'] ) ) {
			return;
		}

		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : null;
		$post = get_post((int) $post_id);
		
		// Checking post existance
		if ( empty($post) ) {
			return;
		}

		// Cheching authorization
		if ( !current_user_can( 'delete_posts', $post_id ) ) {
			return;
		}

		// Delete post and redirect to home
		wp_trash_post( $post_id );
		wp_safe_redirect( home_url() );

		die;
	}
}

add_action( 'init', '_themename_handle_delete_post' );
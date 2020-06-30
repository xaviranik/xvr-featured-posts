<?php

namespace XVR\Featured_Posts\Base;

class Deactivate {
	public static function deactivate() {
		$timestamp = wp_next_scheduled( 'log_post_views_action' );
    	wp_unschedule_event( $timestamp, 'log_post_views_action' );
		flush_rewrite_rules();
	}
}
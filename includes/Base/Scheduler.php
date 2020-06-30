<?php

namespace XVR\Featured_Posts\Base;

/**
 * Scheduler Class
 */
class Scheduler {
	
	public function register() {
		do_action( 'log_post_views_action' );
		add_filter( 'cron_schedules', [ $this, 'add_cron_interval' ] );

		add_action( 'log_post_views_action', [ $this, 'log_post_views' ] );

		if ( ! wp_next_scheduled( 'log_post_views_action' ) ) {
		    wp_schedule_event( time(), 'two_minutes',  'log_post_views_action' );
		}
	}

	public function add_cron_interval( $schedules ) { 
	    $schedules['two_minutes'] = array(
	        'interval' => 120,
	        'display'  => esc_html__( 'Every Two Minutes' ), );
	    return $schedules;
	}

	public function log_post_views() {
		error_log(print_r("Logging...", true));
	}
}
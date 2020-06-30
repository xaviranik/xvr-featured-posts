<?php

namespace XVR\Featured_Posts\Cron;

use XVR\Featured_Posts\Api\Scheduler_Api;

/**
 * Logs posts view
 */
class Log_Post_view {

    /**
     * Class constructor
     */
    public function __construct() {
        
        $scheduler = new Scheduler_Api;
        $scheduler->set([
            'action'        => 'log_post_views_action',
            'callback'        => [$this, 'log_post_views'],
            'interval_name' => 'two_minutes',
        ])->create();
    }

    /**
     * Logs post views
     *
     * @return void
     */
    public function log_post_views() {
		error_log(print_r("Logging...", true));
	}
}

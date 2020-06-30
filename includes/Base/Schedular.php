<?php

namespace XVR\Featured_Posts\Base;

use XVR\Featured_Posts\Api\Schedule_Interval_Api;
use XVR\Featured_Posts\Cron\Log_Post_view;

/**
 * Scheduler Class
 */
class Schedular {
	
	public function register() {

		$cron_interval = new Schedule_Interval_Api;
		$cron_interval->make([
			'name'    => 'two_minutes',
			'display' => 'Every Two Minutes',
		]);

		new Log_Post_view;
	}
}
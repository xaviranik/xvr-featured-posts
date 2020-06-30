<?php

namespace XVR\Featured_Posts\Api;

/**
 * Task Schedular API
 */
class Scheduler_Api {

	/**
	 * Cron job params
	 *
	 * @var array
	 */
	protected $params = [];
	
	/**
	 * Sets the params
	 *
	 * @param array $params
	 * @return object
	 */
	public function set( array $params = [] ) {
		$this->params = $params;
		return $this;
	}

	/**
	 * Creates the cron job
	 *
	 * @return void
	 */
	public function create() {

		if ( ! empty( $this->params ) ) {
			do_action( $this->params['action']) ;
			add_action( $this->params['action'],  $this->params['callback']);

			if (!wp_next_scheduled( $this->params['action']) ) {
				wp_schedule_event(time(), $this->params['interval_name'],  $this->params['action'] );
			}
		}
	}
}
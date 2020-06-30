<?php

namespace XVR\Featured_Posts\Api;

/**
 * Cron Interval Handler Class
 */
class Schedule_Interval_Api {

    /**
     * Cron job interval params
     *
     * @var array
     */
    protected $params = [];

    /**
     * Makes the cron interval
     *
     * @param array $params
     * @return void
     */
    public function make( $params ) {
        $this->params = $params;
        add_filter('cron_schedules', [$this, 'add_cron_interval']);
    }

    /**
     * Adds Cron interval
     *
     * @param array $schedules
     * @return array
     */
    public function add_cron_interval( $schedules ) {
        $schedules[ $this->params['name'] ] = array(
            'interval' => 120,
            'display'  => esc_html__( $this->params['display'] ),
        );
        return $schedules;
    }
}

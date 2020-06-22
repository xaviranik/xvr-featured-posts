<?php 

namespace XVR\Featured_Posts\Base;

use XVR\Featured_Posts\Base\BaseController;

/**
* Enqeues scripts
*/
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'xvrstyle', $this->plugin_url . 'assets/main.css' );
		wp_enqueue_script( 'xvrscript', $this->plugin_url . 'assets/main.js' );
	}
}
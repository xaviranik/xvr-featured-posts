<?php


namespace XVR\Featured_Posts\Api\Callbacks;


use XVR\Featured_Posts\Base\Base_Controller;

class Admin_Callback extends Base_Controller {

	public function featured_posts_settings() {
		require_once $this->plugin_path . 'templates/settings.php';
	}
}
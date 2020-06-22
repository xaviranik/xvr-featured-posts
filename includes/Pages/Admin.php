<?php 
/**
 * @package  AlecadddPlugin
 */
namespace XVR\Featured_Posts\Pages;

use XVR\Featured_Posts\Api\Callbacks\Admin_Callback;
use XVR\Featured_Posts\Api\Settings_Api;
use XVR\Featured_Posts\Base\Base_Controller;

/**
* Admin Settings Page
*/
class Admin extends Base_Controller {

	/**
	 * @var array[]
	 */
	private $pages = [];

	/**
	 * @var array[]
	 */
	private $sub_pages = [];

	/**
	 * @var Settings_Api
	 */
	private $settings;

	/**
	 * @var Admin_Callback
	 */
	private $callback;

	public function register() {

		$this->settings = new Settings_Api();
		$this->callback = new Admin_Callback();

		$this->set_pages();
		$this->settings->add_pages( $this->pages )->with_sub_page( 'Settings' )->add_sub_pages( $this->sub_pages )->register();
	}

	/**
	 * Sets pages
	 */
	public function set_pages() {
		$this->pages = [
			[
				'title' => 'Featured Posts | Settings',
				'menu_title' => 'Featured Posts',
				'capability' => 'manage_options',
				'menu_slug' => 'featured_post_plugin',
				'callback' => [ $this->callback, 'featured_posts_settings' ],
				'icon_url' => 'dashicons-store',
				'position' => 110,
			]
		];
	}
}
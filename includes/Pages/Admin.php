<?php 
/**
 * @package  AlecadddPlugin
 */
namespace XVR\Featured_Posts\Pages;

use XVR\Featured_Posts\Base\BaseController;

/**
* Admin Settings Page
*/
class Admin extends BaseController
{
	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages() {
		add_menu_page( 'Settings', 'Featured Posts', 'manage_options', 'xvr_featured_posts', array( $this, 'admin_index' ), 'dashicons-heart', 110 );
	}

	public function admin_index() {
		require_once $this->plugin_path . 'templates/settings.php';
	}
}
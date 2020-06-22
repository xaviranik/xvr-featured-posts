<?php 
/**
 * @package  AlecadddPlugin
 */
namespace XVR\Featured_Posts\Pages;

use XVR\Featured_Posts\Api\Settings_Api;
use XVR\Featured_Posts\Api\Taxonomy\Category;
use XVR\Featured_Posts\Api\Callbacks\Admin_Callback;

/**
* Admin Settings Page
*/
class Admin {

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

	/**
	 * Registers class dependencies
	 */
	public function register() {

		$this->settings = new Settings_Api();
		$this->callback = new Admin_Callback();

		$this->set_pages();
		$this->set_sub_pages();

		$this->set_settings();
		$this->set_sections();
		$this->set_fields();

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
				'menu_slug' => 'xvr_featured_posts_plugin',
				'callback' => [ $this->callback, 'featured_posts_settings' ],
				'icon_url' => 'dashicons-heart',
				'position' => 110,
			]
		];
	}

	/**
	 * Sets sub pages
	 */
	public function set_sub_pages() {
		$this->sub_pages = array(
			[
				'parent_slug' => 'xvr_featured_posts_plugin',
				'title' => 'About',
				'menu_title' => 'About',
				'capability' => 'manage_options',
				'menu_slug' => 'xvr_featured_posts_plugin_about',
				'callback' => [ $this->callback, 'featured_posts_about' ]
			],
		);
	}

	public function set_settings() {
		$args = [
			[
				'option_group' => 'xvr_featured_posts_option_group',
				'option_name' => 'num_of_posts',
				'callback' => [ $this->callback,  'xvr_featured_posts_option_group'],
			],
			[
				'option_group' => 'xvr_featured_posts_option_group',
				'option_name' => 'sorting_post',
				'callback' => [ $this->callback,  'xvr_featured_posts_option_group'],
			],
			[
				'option_group' => 'xvr_featured_posts_option_group',
				'option_name' => 'categories_post',
				'callback' => [ $this->callback,  'xvr_featured_posts_option_group'],
			]
		];

		$this->settings->set_settings( $args );
	}

	public function set_sections() {
		$args = [
			[
				'id' => 'xvr_featured_posts_settings_index_id',
				'title' => 'Manage Featured Post Settings',
				'callback' => [ $this->callback,  'xvr_featured_posts_admin_section' ],
				'page' => 'xvr_featured_posts_plugin',
			]
		];

		$this->settings->set_sections( $args );
	}

	public function set_fields() {
		$args = [
			[
				'id' => 'num_of_posts',
				'title' => 'Number of Posts',
				'callback' => [ $this->callback,  'xvr_featured_posts_input_field'],
				'page' => 'xvr_featured_posts_plugin',
				'section' => 'xvr_featured_posts_settings_index_id',
				'args' => [
					'label_for' => 'num_of_posts',
					'placeholder' => '(eg. 10)',
				],
			],
			[
				'id' => 'sorting_post',
				'title' => 'Post Sorting',
				'callback' => [ $this->callback,  'xvr_featured_posts_select_box'],
				'page' => 'xvr_featured_posts_plugin',
				'section' => 'xvr_featured_posts_settings_index_id',
				'args' => [
					'label_for' => 'sorting_post',
					'options' => [
						'asc' => 'Ascending',
						'desc' => 'Descending',
						'random' => 'Random'
					]
				],
			],
			[
				'id' => 'categories_post',
				'title' => 'Post Categories',
				'callback' => [ $this->callback,  'xvr_featured_posts_select_box'],
				'page' => 'xvr_featured_posts_plugin',
				'section' => 'xvr_featured_posts_settings_index_id',
				'args' => [
					'label_for' => 'categories_post[]',
					'options' => Category::get_categories(),
					'is_multiple' => true,
					'name' => 'categories_post'
				],
			],
		];

		$this->settings->set_fields( $args );
	}
}
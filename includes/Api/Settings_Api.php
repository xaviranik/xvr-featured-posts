<?php

namespace XVR\Featured_Posts\Api;


class Settings_Api {

	/**
	 * @var array
	 */
	public $admin_pages = [];
	/**
	 * @var array[]
	 */
	private $admin_sub_pages = [];

	/**
	 * @var array
	 */
	private $settings = [];

	/**
	 * @var array
	 */
	private $sections = [];

	/**
	 * @var array
	 */
	private $fields = [];

	/**
	 *  Registers
	 */
	public function register() {
		if ( ! empty( $this->admin_pages ) ) {
			add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		}

		if ( ! empty( $this->settings ) ) {
			add_action( 'admin_init', [ $this, 'register_custom_fields' ] );
		}
	}

	/**
	 * @param array $pages
	 * @return $this
	 */
	public function add_pages(array $pages ) {
		$this->admin_pages = $pages;
		return $this;
	}

	public function with_sub_page( string $title = null ) {
		if ( empty( $this->admin_pages ) ) {
			return $this;
		}

		$admin_page = $this->admin_pages[0];

		$sub_page = [
			[
				'parent_slug' => $admin_page['menu_slug'],
				'title' => $admin_page['title'],
				'menu_title' => $title ? $title : $admin_page['menu_title'],
				'capability' => $admin_page['capability'],
				'menu_slug' => $admin_page['menu_slug'],
				'callback' => $admin_page['callback'],
			]
		];

		$this->admin_sub_pages = $sub_page;

		return $this;
	}

	/**
	 * Adds all admin pages
	 */
	public function add_admin_menu() {
		foreach ( $this->admin_pages as $page ) {
			add_menu_page( $page['title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
		}

		foreach ( $this->admin_sub_pages as $page ) {
			add_submenu_page( $page['parent_slug'], $page['title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
		}
	}

	/**
	 * @param array $pages
	 * @return $this
	 */
	public function add_sub_pages( array $pages )
	{
		$this->admin_sub_pages = array_merge( $this->admin_sub_pages, $pages );

		return $this;
	}

	/**
	 * Registers custom fields
	 * @return void
	 */
	public function register_custom_fields() {
		// Register setting
		foreach ( $this->settings as $setting ) {
			register_setting( $setting['option_group'], $setting['option_name'], isset( $setting['callback'] ) ? $setting['callback'] : '' );
		}

		// Add settings section
		foreach ( $this->sections as $section ) {
			add_settings_section( $section['id'], $section['title'], isset( $section['callback'] ) ? $section['callback'] : '', $section['page'] );
		}

		// Add settings field
		foreach ( $this->fields as $field ) {
			add_settings_field( $field['id'], $field['title'], isset( $field['callback'] ) ? $field['callback'] : '', $field['page'], $field['section'], isset( $field['args'] ) ? $field['args'] : '' );
		}
	}

	/**
	 * @param array $settings
	 *
	 * @return $this
	 */
	public function set_settings( array $settings ) {
		$this->settings = $settings;
		return $this;
	}

	/**
	 * @param array $sections
	 *
	 * @return $this
	 */
	public function set_sections( array $sections ) {
		$this->sections = $sections;
		return $this;
	}

	/**
	 * @param array $fields
	 *
	 * @return $this
	 */
	public function set_fields( array $fields ) {
		$this->fields = $fields;
		return $this;
	}
}
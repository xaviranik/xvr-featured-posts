<?php


namespace XVR\Featured_Posts\Pages;

use XVR\Featured_Posts\Shortcodes\Featured_Posts;

class Frontend {

	/**
	 * Registers class dependencies
	 */
	public function register() {
		new Featured_Posts();
	}

}
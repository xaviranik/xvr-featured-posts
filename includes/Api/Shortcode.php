<?php


namespace XVR\Featured_Posts\Api;


abstract class Shortcode {

	public function register_shortcode( $shortcode ) {
		add_shortcode( $shortcode, [ $this, 'render' ] );
	}

	abstract function render( $attr = [], $content = null );

}
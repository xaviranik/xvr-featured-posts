<?php


namespace XVR\Featured_Posts\Api\Callbacks;


use XVR\Featured_Posts\Base\Base_Controller;

class Admin_Callback extends Base_Controller {

	public function featured_posts_settings() {
		require_once $this->plugin_path . 'templates/settings.php';
	}

	public function featured_posts_about() {
		require_once $this->plugin_path . 'templates/about.php';
	}

	public function xvr_featured_posts_admin_section() {
		echo "Note: Modifying these numbers will effect the shortcode.";
	}

	public function xvr_featured_posts_option_group( $input ) {
		return is_array( $input ) ? $input : esc_attr( $input );
	}

	public function xvr_featured_posts_input_field( $args ) {
		$name = $args['label_for'];
		$placeholder = $args['placeholder'];

		$value = esc_attr( get_option( $name ) );
		echo '<input type="text" class="regular-text" name="'. $name .'" value="' . $value . '" placeholder="' . $placeholder . '">';
	}

	public function xvr_featured_posts_select_box( $args ) {
		$name = isset( $args['name'] ) ? $args['name'] : $args['label_for'];
		$options = $args['options'];
		$is_multiple = isset( $args['is_multiple'] ) ? $args['is_multiple'] ? 'multiple' : '' : '';

		$value = get_option( $name );

		$select_options = '';
		foreach ( $options as $key => $option ) {
			$is_selected = $this->get_selected_item( $key, $value );
			$select_options .= '<option value="'. $key .'" ' . $is_selected . '>'. $option . '</option>';
		}

		$output = '<select name="' . $name . '[]" id="' . $name . '" ' . $is_multiple. '>';
		$output .= $select_options;
		$output .= '</select>';
		echo  $output;
	}

	private function get_selected_item( $key, $value ) {
		if ( ! is_array( $value ) ) {
			return $key == $value ? 'selected' : '';
		}
		return in_array($key, $value) ? 'selected' : '';
	}
}
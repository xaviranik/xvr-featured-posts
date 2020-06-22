<?php

namespace XVR\Featured_Posts\Shortcodes;

use XVR\Featured_Posts\Api\Shortcode;

class Featured_Posts extends Shortcode {

	public function __construct() {
		$this->register_shortcode('featured-posts');
	}

	function render( $attr = [], $content = null ) {
		$output = "";
		$num_of_posts = get_option( 'num_of_posts' );
		$categories_post = get_option( 'categories_post' );
		$sorting_post = get_option( 'sorting_post' );

		$sorting_choice = [ 'asc', 'desc' ];

		$params = shortcode_atts([
			'posts_per_page' => $num_of_posts,
			'category_name' => implode (", ", $categories_post ),
			'order' => $sorting_post[0] == 'random' ? $sorting_choice[ array_rand( $sorting_choice, 1 ) ] : $sorting_post[0],
		], $attr);

		$query = new \WP_Query($params);

		if ( $query->have_posts() ) {
			while ($query->have_posts()) {
				$query->the_post();

				?>
				<h6><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h6>
				<?php
			}
			wp_reset_postdata();
		}

		return $output;
	}
}
<?php


namespace XVR\Featured_Posts\Api\Taxonomy;


class Category {

	public static function get_categories() {
		$categories = get_categories();
		$results = [];

		foreach ( $categories as $category ) {
			$results[$category->slug] = $category->name;
		}

		return $results;
	}
}
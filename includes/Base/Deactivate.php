<?php

namespace XVR\Featured_Posts\Base;

class Deactivate {
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
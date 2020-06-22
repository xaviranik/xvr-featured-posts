<?php

namespace XVR\Featured_Posts\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();
	}
}
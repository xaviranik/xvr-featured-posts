<div class="wrap">
    <h1>Settings</h1>
	<?php settings_errors() ?>
    <form method="post" action="options.php">
		<?php
		settings_fields( 'xvr_featured_posts_option_group' );
		do_settings_sections( 'xvr_featured_posts_plugin' );
		submit_button();
		?>
    </form>
</div>
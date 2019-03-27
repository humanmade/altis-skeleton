<?php
/**
 * The default template file.
 *
 * This file is yours to edit and replace.
 */

get_header();

?>
	<div id="welcome">
		<h1><?php esc_html_e( 'Welcome to HM Platform', 'hm-platform' ) ?></h1>
		<p><?php _e( 'HM Platform is installed and ready to go. To get started, edit this placeholder theme at<br><code>content/themes/base</code>', 'hm-platform' ) ?></p>
		<p><a href="<?php echo admin_url( 'admin.php?page=hm-platform' ) ?>"><?php esc_html_e( 'View HM Platform documentation', 'hm-platform' ) ?></a></p>
	</div>
<?php

get_footer();

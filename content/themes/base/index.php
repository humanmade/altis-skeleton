<?php
/**
 * The default template file.
 *
 * This file is yours to edit and replace.
 */

get_header();

?>
	<div id="welcome">
		<?php Altis\CMS\Branding\render_logo( 'white' ) ?>
		<p><?php _e( 'Altis is installed and ready to go.', 'altis' ) ?>
		<p><?php _e( 'Edit this placeholder theme at<br><code>content/themes/base</code>', 'hm-platform' ) ?></p>
		<p><a href="<?php echo Altis\Documentation\get_url_for_page( 'getting-started', 'first-theme.md' ) ?>"><?php esc_html_e( 'View documentation 🚀', 'hm-platform' ) ?></a></p>
	</div>
<?php

get_footer();

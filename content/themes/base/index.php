<?php
/**
 * The default template file.
 *
 * This file is yours to edit and replace.
 */

get_header();

$folder_path = 'content/themes/base';

if ( file_exists( '/etc/chassis-constants' ) ) {
	$json_string = file_get_contents( '/etc/chassis-constants' );
	$data = json_decode( $json_string, true );
	$folder_path = $data['synced_folders']['/chassis'].'/content/themes/base';
}

?>
	<div id="welcome">
		<?php Altis\CMS\Branding\render_logo( 'white' ) ?>
		<p><?php _e( 'Altis is installed and ready to go.', 'altis' ) ?>
		<p><?php
			echo sprintf(
				__( 'Edit this placeholder theme at:<br><code>%s</code>', 'hm-platform' ),
				$folder_path
			); ?></p>
		<p><a href="<?php echo Altis\Documentation\get_url_for_page( 'getting-started', 'first-theme.md' ) ?>"><?php esc_html_e( 'View documentation 🚀', 'hm-platform' ) ?></a></p>
	</div>
<?php

get_footer();

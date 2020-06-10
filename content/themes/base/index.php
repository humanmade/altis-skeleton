<?php
/**
 * The default template file.
 *
 * This file is yours to edit and replace.
 *
 * @package altis/skeleton
 */

get_header();

$folder_path = 'content/themes/base';

if ( file_exists( '/etc/chassis-constants' ) ) {
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$json_string = file_get_contents( '/etc/chassis-constants' );
	$data = json_decode( $json_string, true );
	if ( ! empty( $data ) && ! empty( $data['synced_folders']['/chassis'] ) ) {
		$folder_path = $data['synced_folders']['/chassis'] . '/content/themes/base';
	}
}

?>
	<div id="welcome">
		<?php Altis\CMS\Branding\render_logo( 'white' ); ?>
		<p><?php esc_html_e( 'Altis is installed and ready to go.', 'altis' ); ?></p>
		<p>
			<?php
			echo sprintf(
				wp_kses(
					// translators: %s replaced by file path to theme.
					__( 'Edit this placeholder theme at:<br><code>%s</code>', 'hm-platform' ),
					[
						'br' => [],
						'code' => [],
					]
				),
				esc_html( $folder_path )
			);
			?>
		</p>
		<p><a href="<?php echo esc_attr( Altis\Documentation\get_url_for_page( 'getting-started', 'first-theme.md' ) ); ?>"><?php esc_html_e( 'View documentation 🚀', 'hm-platform' ); ?></a></p>
	</div>
<?php

get_footer();

<div class="social-header">

	<?php
	$social_options = get_option( 'wpseo_social', '' );
	$facebook = $social_options['facebook_site'];
	$twitter = $social_options['twitter_site'];
	$instagram = $social_options['instagram_url'];
	$pinterest = $social_options['pinterest_url'];
	$youtube = $social_options['youtube_url'];
	$linkedin = $social_options['linkedin_url'];
	
	// Social icons that aren't managed by Yoast
	$additional_social_options = get_option( 'fsc_options', '' );
	$vimeo = $additional_social_options['vimeo_url'] ? $additional_social_options['vimeo_url'] : '';
	
	if ( '' !== $facebook ) {
		?>
		<a class="social-icon" target="_blank" rel="noopener" aria-label="Facebook" href="<?php echo esc_url( $facebook ); ?>" title="Facebook">
			<svg class="fs-icons">
				<use xlink:href="#icon-facebook-square"></use>
			</svg>
		</a>
		<?php
	}

	if ( '' !== $twitter ) {
		?>
		<a class="social-icon" target="_blank" rel="noopener" aria-label="Twitter" href="<?php echo __( 'https://twitter.com/' ) . $twitter; ?>" title="Twitter">
			<svg class="fs-icons">
				<use xlink:href="#icon-twitter-square"></use>
			</svg>
		</a>
		<?php
	}

	if ( '' !== $instagram ) {
		?>
		<a class="social-icon" target="_blank" rel="noopener" aria-label="Instagram" href="<?php echo esc_url( $instagram ); ?>" title="Instagram">
			<svg class="fs-icons">
				<use xlink:href="#icon-instagram-square"></use>
			</svg>
		</a>
		<?php
	}

	if ( '' !== $pinterest ) {
		?>
		<a class="social-icon" target="_blank" rel="noopener" aria-label="Pinterest" href="<?php echo esc_url( $pinterest ); ?>" title="Pinterest">
			<svg class="fs-icons">
				<use xlink:href="#icon-pinterest-square"></use>
			</svg>
		</a>
		<?php
	}

	if ( '' !== $youtube ) {
		?>
		<a class="social-icon" target="_blank" rel="noopener" aria-label="Youtube" href="<?php echo esc_url( $youtube ); ?>" title="YouTube">
			<svg class="fs-icons">
				<use xlink:href="#icon-youtube-square"></use>
			</svg>
		</a>
		<?php
	}

	if ( '' !== $vimeo ) {
		?>
		<a class="social-icon" target="_blank" rel="noopener" aria-label="Vimeo" href="<?php echo esc_url( $vimeo ); ?>" title="Vimeo">
			<svg class="fs-icons">
				<use xlink:href="#icon-vimeo-square"></use>
			</svg>
		</a>
		<?php
	}

	if ( '' !== $linkedin ) {
		?>
		<a class="social-icon" target="_blank" rel="noopener" aria-label="Linkedin" href="<?php echo esc_url( $linkedin ); ?>" title="LinkedIn">
			<svg class="fs-icons">
				<use xlink:href="#icon-linkedin-square"></use>
			</svg>
		</a>
		<?php
	}

	?>

</div>

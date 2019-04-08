<?php
/**
 * The functions necesary for the Sharebar functions
 *
 * @link       http://williambay.com
 * @since      1.0.0
 *
 * @package    Flaunt_Sites_Core
 */

// Get the page URL.
// $page_url = the_permalink();

function echo_this() {
	$page_url = the_permalink();
	return $page_url;
}
// echo_this();


// The Sharebar markup template.
$sharebar = '<div class="fs-sharebar">
<span>Share this photo:</span>
<a href="https://www.facebook.com/sharer.php?u="><svg class="fs-icons"><use xlink:href="#icon-facebook-square"></use></svg></a>									
<a href="#"><svg class="fs-icons"><use xlink:href="#icon-twitter-square"></use></svg></a>
<a href="#"><svg class="fs-icons"><use xlink:href="#icon-instagram-square"></use></svg></a>									
<a href="#"><svg class="fs-icons"><use xlink:href="#icon-pinterest-square"></use></svg></a>																	
</div>';


/**
 * Replaces Images wrapped in <Figure> and replaces it with new Figure and adds Sharebare wrapper.
 *
 * @param Data $content The content to filter.
 */
function fsc_replace_figure_with_figure( $content ) {

	global $sharebar;
	$content = preg_replace(
		'/(<figure.*?>)\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)\\s*?(<figcaption.*?>.*?<\\/figcaption>)?s*<\\/figure>/s',
		'$1
		 $2
			<a class="fs-drawer-mobile-more"><svg class="fs-icons"><use xlink:href="#icon-more"></use></svg></a>
			<div class="fs-drawer">
			$3
			' . $sharebar . '
			</div>
		</figure>',
		$content
	);
	return $content;
}
// add_filter( 'the_content', 'fsc_replace_figure_with_figure', 99 );



/**
 * Replaces Images wrapped in <Figure> and <Div> tags associated in Gallery items
 *
 * @param Data $content The content to filter.
 */
function fsc_replace_gallery_figure_with_figure( $content ) {

	global $sharebar;
	$content = preg_replace(
		'/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
		'<figure>
			$1
			<a class="fs-drawer-mobile-more"><svg class="fs-icons"><use xlink:href="#icon-more"></use></svg></a>
			<div class="fs-drawer">
				<figcaption></figcaption>
				' . $sharebar . '
			</div>
		</figure>',
		$content
	);
	return $content;
}
// add_filter( 'the_content', 'fsc_replace_gallery_figure_with_figure', 99 );


/**
 * Replaces Images wrapped in <a> tag with <figure>
 *
 * @param Data $content The content to filter.
 */
function fsc_replace_a_with_figure( $content ) {

	global $sharebar;
	$content = preg_replace(
		'/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
		'<figure>
			$1
			<a class="fs-drawer-mobile-more"><svg class="fs-icons"><use xlink:href="#icon-more"></use></svg></a>
			<div class="fs-drawer">
				<figcaption></figcaption>
				' . $sharebar . '
			</div>
		</figure>',
		$content
	);
	return $content;
}
// add_filter( 'the_content', 'fsc_replace_a_with_figure', 99 );



/**
 * Replaces Images wrapped in <P> tag with <figure>
 *
 * @param Data $content The content to filter.
 */
function fsc_replace_p_with_figure( $content ) {

	global $sharebar;
	$content = preg_replace(
		'/<p>\\s*?(<img.*?>|<img.*?>)?\\s*<\\/p>/s',
		'<figure>
			$1
			<a class="fs-drawer-mobile-more"><svg class="fs-icons"><use xlink:href="#icon-more"></use></svg></a>
			<div class="fs-drawer">
				<figcaption></figcaption>
				' . $sharebar . '
			</div>
		</figure>',
		$content
	);
	return $content;
}
// add_filter( 'the_content', 'fsc_replace_p_with_figure', 99 );

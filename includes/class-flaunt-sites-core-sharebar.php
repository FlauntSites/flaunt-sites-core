<?php 

/**
 * Replaces Images wrapped in <P> tag with <figure>
 * 
 */

function fsc_replace_p_with_figure( $content )
{ 
    $content = preg_replace( 
        '/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', 
		'<figure>
			$1
			<div class="fs-drawer">

				<figcaption>Goodbye Cruel World.</figcaption>

				<div class="fs-sharebar">
					<span>Share this photo:</span>
					<a href="#"><svg class="fs-icons"><use xlink:href="#icon-facebook-square"></use></svg></a>									
					<a href="#"><svg class="fs-icons"><use xlink:href="#icon-twitter-square"></use></svg></a>
					<a href="#"><svg class="fs-icons"><use xlink:href="#icon-instagram-square"></use></svg></a>									
					<a href="#"><svg class="fs-icons"><use xlink:href="#icon-pinterest-square"></use></svg></a>	
					<a href="#"><svg class="fs-icons"><use xlink:href="#icon-google-plus-square"></use></svg></a>									
					
					<span>Puchase option:</span>

					<a href=""><svg class="fs-icons"><use xlink:href="#icon-google-plus-square"></use></svg></a>									
				</div>

			</div>
		</figure>', 
        $content 
    ); 
    return $content; 
} 
add_filter( 'the_content', 'fsc_replace_p_with_figure', 99 );

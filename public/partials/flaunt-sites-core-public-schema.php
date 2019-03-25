<?php 

function fsc_schema_main(){

        $logo       = get_option( 'fsc_options', '' );
        $logo 		= $logo[ 'fsc_logo' ];
        $logo_url 	= $logo[ 'url' ]; 
        
        ?>

        <script type='application/ld+json'>
            {
                "@context": "http://www.schema.org",
                "@type": "ProfessionalService",
                "name": "<?php the_field( 'fsc_business_name', 'options' ); ?>",
                "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
                <?php if (isset ( $logo ) ) { ?>
                "logo": "<img src="<?php echo $logo_url; ?>",
                <?php } ?>
                "telephone": "<?php the_field( 'fsc_phone_number', 'options' ); ?>",

                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "<?php the_field( 'fsc_address_line_1', 'options' ); ?>",
                    "addressLocality": "<?php the_field( 'fsc_city', 'options' ); ?>",
                    "addressRegion": "<?php the_field( 'fsc_state', 'options' ); ?>",
                    "postalCode": "<?php the_field( 'fsc_postal_code', 'options' ); ?>",
                    "addressCountry": "<?php the_field( 'fsc_country', 'options' ); ?>"
                },

                "sameAs": [
                    "<?php the_field( 'fsc_facebook_url', 'options' ); ?>",
                    "<?php the_field( 'fsc_twitter_url', 'options' ); ?>",
                    "<?php the_field( 'fsc_instagram_url', 'options' ); ?>",
                    "<?php the_field( 'fsc_pinterest_url', 'options' ); ?>"
                ]
            }
        </script>
<?php }

// add_action( 'wp_enqueue_scripts', 'fsc_schema_main' );



function fsc_schema_aggregate_reviews(){
    $review_count = wp_count_posts( 'reviews' )->publish;

    $rating_value = get_posts( array(
        'numberposts'	    => -1,
        'post_type'			=> 'reviews',
        'meta_key'          => 'fsc_stars',
        )
    );
    
    $event_query = new WP_Query( );
    if ( is_page( 'reviews' ) ){ 
    ?>

        <script type='application/ld+json'>
        
            {
            "@context": "http://schema.org/",
            "@type": "Product",
            "name": "",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue" : "<?php echo $rating_value ?>",
                "reviewCount": "<?php echo $review_count ?>"
                }
            }

        </script>

    <?php }

}

// add_action( 'wp_enqueue_scripts', 'fsc_schema_aggregate_reviews' );



function fsc_schema_post(){ 

    if ( is_singular( 'post' ) ){ ?>

        <script type='application/ld+json'>{
                "@context": "http://www.schema.org",
                "@type": "BlogPosting",
                "headline": "<?php the_title(); ?>",
                "author": "<?php the_author(); ?>",
                "datePublished": "<?php the_date(); ?>",
                "publisher": "<?php the_author(); ?>",
                "image": "<?php the_post_thumbnail_url( 'medium' ); ?>"
            }</script>

    <?php } 

}

add_action( 'the_post', 'fsc_schema_post' );











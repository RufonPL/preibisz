<?php /* Template Name: Lista Newsy */ ?>

<?php
    $args = array(
        'numberposts'   => 5,
        'post_type'     => 'news',
    );
    // query
    $the_query = new WP_Query( $args );
?>
<?php if( $the_query->have_posts() ): ?>
	<?php 
        while( $the_query->have_posts() ) : $the_query->the_post(); 
    ?>
		<div class="row top10 post-item">
			<a href="<? the_permalink(); ?>">
		        <div class="col-xs-4">
		        	<div class="img">
			        	<? if(has_post_thumbnail()): ?>
				            <img src="<?php the_post_thumbnail_url( 'small' ); ?>" class="scale" data-scale="best-fill" data-align="center" width="100%" />
				        <? else: ?>
				        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/no_image.png" class="scale" data-scale="best-fill" data-align="center" width="100%" />
				        <? endif; ?>
			        </div>
		        </div>
		        <div class="col-xs-8">
		            <?php the_title(); ?>
		        </div>
	        </a>
	    </div>
	<? endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
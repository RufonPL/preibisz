<?php /* Template Name: Specjaliści */ ?>
<?php get_header(); ?>
<section class="top100"></section>
<?php
    $args = array(
        'post_type'     => 'doctors',
        'orderby' 		=> 'date',
        'order'			=> 'ASC'
    );
    // query
    $the_query = new WP_Query( $args );
?>
<?php if( $the_query->have_posts() ): ?>
	<?php 
		$i = 0;
        while( $the_query->have_posts() ) : $the_query->the_post(); 
    ?>
    	<section class="doctor">
    		<? if($i == 0 || $i%2 == 0): ?>
	    		<div class="container">
	    			<div class="col-sm-4 center">
	    				<div class="img">
		    				<? if(has_post_thumbnail()): ?>
					            <img src="<?php the_post_thumbnail_url( 'large' ); ?>" width="100%" />
					        <? else: ?>
					        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/no_image.png" width="100%" />
					        <? endif; ?>
				        </div>
				        <h1><? the_title(); ?></h1>
	    			</div>
	    			<!--
	    			<div class="col-sm-3">
	    				<h1><? the_title(); ?></h1>
	    				<? if(get_field('degree')): ?>
	    					<h4><? the_field('degree'); ?></h4>
	    				<? endif; ?>
	    				<? if(get_field('specialization')): ?>
	    					<h4><? the_field('specialization'); ?></h4>
	    				<? endif; ?>
	    				<? if(get_field('monday')): ?>
	    					<p><b>Poniedziałek: </b> <? the_field('monday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('tuesday')): ?>
	    					<p><b>Wtorek: </b> <? the_field('tuesday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('wednesday')): ?>
	    					<p><b>Środa: </b> <? the_field('wednesday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('thursday')): ?>
	    					<p><b>Czwartek: </b> <? the_field('thursday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('friday')): ?>
	    					<p><b>Piątek: </b> <? the_field('friday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('saturday')): ?>
	    					<p><b>Sobota: </b> <? the_field('saturday'); ?></p>
	    				<? endif; ?>
	    			</div>
	    			-->
	    			<div class="col-sm-8">
	    				<span class="txt">
	    					<?php the_content(); ?>
	    				</span>
	    			</div>
	    		</div>
    		<? else: ?>
    			<div class="container">
    				<div class="col-sm-8">
	    				<span class="txt">
	    					<?php the_content(); ?>
	    				</span>
	    			</div>
	    			<!--
	    			<div class="col-sm-3">
	    				<h1><? the_title(); ?></h1>
	    				<? if(get_field('degree')): ?>
	    					<h4><? the_field('degree'); ?></h4>
	    				<? endif; ?>
	    				<? if(get_field('specialization')): ?>
	    					<h4><? the_field('specialization'); ?></h4>
	    				<? endif; ?>
	    				<? if(get_field('monday')): ?>
	    					<p><b>Poniedziałek: </b> <? the_field('monday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('tuesday')): ?>
	    					<p><b>Wtorek: </b> <? the_field('tuesday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('wednesday')): ?>
	    					<p><b>Środa: </b> <? the_field('wednesday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('thursday')): ?>
	    					<p><b>Czwartek: </b> <? the_field('thursday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('friday')): ?>
	    					<p><b>Piątek: </b> <? the_field('friday'); ?></p>
	    				<? endif; ?>
	    				<? if(get_field('saturday')): ?>
	    					<p><b>Sobota: </b> <? the_field('saturday'); ?></p>
	    				<? endif; ?>
	    			</div>
	    			-->
	    			<div class="col-sm-4 center">
	    				<div class="img">
		    				<? if(has_post_thumbnail()): ?>
					            <img src="<?php the_post_thumbnail_url( 'large' ); ?>" width="100%" />
					        <? else: ?>
					        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/no_image.png" width="100%" />
					        <? endif; ?>
				        </div>
				        <h1><? the_title(); ?></h1>
	    			</div>
	    			
	    		</div>
    		<? endif; ?>
    	</section>
    	<? $i++; ?>
	<? endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
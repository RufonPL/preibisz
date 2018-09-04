<?php get_header(); ?>

<div class="container top130">
	<div class="col-md-12 single">
        <?php 
            $args = array(
                'numberposts'   => 18,
                'post_type'     => 'media',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'mediacats',
                        'field' => 'slug',
                        'terms' => 'filmy'
                    )
                )
            );

            // query
            $the_query = new WP_Query($args); 
        ?>
        <?php if($the_query->have_posts() ): ?>
            <?php  
                $i = 0; 
                $featured_count = $the_query->post_count;
            ?>
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <? if($i == 0 || $i%3 == 0): ?>
                    <div class="row">
                <? endif; ?>
                        <div class="col-sm-4">
                            <a class="nounderline" href="<? the_permalink(); ?>">
                                <div class="card">
                                    <? if(has_post_thumbnail()) : ?>
                                        <div class="relative img">
                                            <img class="card-img-top scale" data-scale="best-fill" data-align="center" style="width:100%" src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title(); ?>">
                                            <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                                                <div class="play"></div>
                                            <? endif; ?>
                                        </div>
                                    <? endif; ?>
                                    <div class="card-block">
                                        <? if(has_post_thumbnail()) : ?>
                                            <h4 class="card-title nounderline">
                                                <span>
                                                <?php the_title(); ?>
                                                </span>
                                            </h4>
                                        <? else: ?>
                                            <h4 class="card-title nounderline">
                                                <span style="top: 0px">
                                                <?php the_title(); ?>
                                                </span>
                                            </h4>
                                        <? endif; ?>
                                        <p class="card-text justify nounderline">
                                            <?php echo strlen(wp_strip_all_tags(get_the_content())) > 256 ? mb_substr(wp_strip_all_tags(get_the_content()),0,256).'...': wp_strip_all_tags(get_the_content()); ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                <? if($featured_count == 1 || $i%3 == 2): ?>
                    </div>
                <? endif; ?>
            <?php 
                $featured_count--;
                $i++;
                endwhile; 
            ?>
		<?php else : ?>

			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<h1>Nie znaleziono filmów</h1>
			</div> 

		<?php endif; ?>
        <div class="pagination"> <?php wp_pagenavi(); ?></div> 

	</div>
	
</div>

<?php get_footer(); ?>
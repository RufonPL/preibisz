<?php get_header(); ?>

<div class="container top130">
	<div class="col-md-8 single">
        <h1><p>Tag: <span class="btn btn-lg btn-skindoctor"><?php single_tag_title(); ?></span></p></h1>
        <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'posts_per_page'    =>  5,
                'post_type'         =>  'treatments',
                'paged'             =>  $paged,
                'tag'               =>  get_queried_object()->slug
            );

            // query
            $the_query = new WP_Query( $args );
        ?>
        <?php if( have_posts() ): ?>
            <?php while( have_posts() ) : the_post(); ?>
                <? if(has_post_thumbnail()) : ?>
                    <div class="img">
                        <img width="100%;" class="scale" data-scale="best-fill" data-align="center" src="<? the_post_thumbnail_url('large'); ?>" />
                    </div>
                <? endif; ?>
                <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                    <div class="center">
                        <div class="player <? if(!has_post_thumbnail()) : ?>normal<? endif; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-icon.png" /></div>
                    </div>
                <? endif; ?>
    			<h1 class="center uppercase <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?> pulltop40 <? endif; ?>"><?php the_title(); ?></h1>
    			
                <div class="justify">
                    <p>
        				<?php echo strlen(wp_strip_all_tags(get_the_content())) > 1024 ? mb_substr(wp_strip_all_tags(get_the_content()),0,1024).'...': wp_strip_all_tags(get_the_content()); ?>
        			</p>
                </div>
                
                <?php
                    $categories = get_the_category(); 
                    $cat = $categories[0];
                ?>
                <div class="row bottom20">
                    <div class="col-sm-6">
                        <a href="<? the_permalink(); ?>" class="btn btn-lg btn-skindoctor-dark">przejdź do artykułu</a>
                    </div>
                    <div class="col-sm-6">
                        <? if($categories): ?>
                            <? $cat = $categories[0]; ?>
                            <a href="<? echo get_term_link($cat->term_id); ?>" class="btn btn-sm btn-skindoctor pull-right top10"><? echo get_the_category()[0]->name; ?></a>
                        <? endif;?>
                    </div>
                </div>
                <hr>
    		<?php endwhile; ?>
		<?php else : ?>

			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<h1>Nie znaleziono zabiegów</h1>
			</div> 

		<?php endif; ?>
        <div class="pagination"> <?php wp_pagenavi(); ?></div> 
        <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

	</div>
	<div class="col-md-4">
		<?php include ('sidebar.php'); ?>
	</div>
</div>

<?php get_footer(); ?>
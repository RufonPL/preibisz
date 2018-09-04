<?php get_header(); ?>

<div class="container top130">
    <div class="col-md-8 single">
        <? 
            $tags = []; 
            $tags_str = "";
            $post_id = 0;
        ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <span class="left">
                <small>
                    <a href="<? echo get_site_url(); ?>">Strona główna</a> | <a href="<? echo get_post_type_archive_link('news'); ?>">Aktualności</a> | <?php the_title(); ?>
                </small>
            </span>
            
            <? if(has_post_thumbnail()): ?>
                <div class="img">
                    <img class="scale" data-scale="best-fill" data-align="center" width="100%;" src="<? the_post_thumbnail_url('large'); ?>" />
                </div>
            <? endif; ?>
            <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                <div class="center">
                    <div class="player <? if(!has_post_thumbnail()) : ?>normal<? endif; ?>"><img data-scale="best-fill" data-align="center" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play-icon.png" /></div>
                </div>
            <? endif; ?>
            
            <h1 class="center uppercase <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?> pulltop40 <? endif; ?>"><?php the_title(); ?></h1>
            
            <div class="justify">
                <p>
                    <?php the_content(); ?>
                </p>
            </div>

            <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                <div class="center">
                    <?if(get_field('if_embedd') && get_field('if_embedd') == true): ?>
                        <div class="embed-container">
                            <?php the_field('embedd_url'); ?>
                        </div>
                    <? else: ?>
                        <a target="_blank" href="<? echo get_field('embedd_url', false, false); ?>" class="btn btn-lg btn-skindoctor-dark"> Zobacz film</a>
                    <? endif;?>
                </div>
            <? endif; ?>

            <? include('gallery.php'); ?>
            
            <?
                $tags = get_the_tags();
                $post_id = get_the_ID();
                if($tags) {
                    foreach($tags as $k => $tag) {
                        if($k == 0) {
                            $tags_str = $tag->slug;
                        } else {
                            $tags_str .= ",".$tag->slug;
                        }
                    }
                }
            ?>
            <? if($tags) { ?>
                <div class="top20">
                    <p>
                        <? foreach($tags as $tag): ?>
                            <div class="btn btn-sm btn-skindoctor"><? echo $tag->name; ?></div>
                        <? endforeach; ?>
                    </p>
                </div>
            <? } ?>
            
        <?php endwhile; ?>

            <div class="navigation">
                <div class="next-posts"><?php next_posts_link(); ?></div>
                <div class="prev-posts"><?php previous_posts_link(); ?></div>
            </div>

        <?php else : ?>

            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h1>Not Found</h1>
            </div> 

        <?php endif; ?>
        <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    </div>
    <div class="col-md-4">
        <?php include ('sidebar.php'); ?>
    </div>
</div>

<?php get_footer(); ?>
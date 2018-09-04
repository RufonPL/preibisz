<?php
    $args = array(
        'numberposts'   => -1,
        'post_type'     => ['treatments', 'tips'],
        'meta_key'      => 'if_featured',
        'meta_value'    => 1,
        'tag'           => $tags_str,
        'post__not_in'  => array($post_id),
    );

    // query
    $the_query = new WP_Query( $args );
?>
<?php if( $the_query->have_posts() ): ?>
    <?php $featured_count = $the_query->post_count; ?>
    <div class="featured-treatments bottom30">
<!--        <h1 class="center uppercase">Polecane zabiegi</h1>-->
        <p class="center uppercase h1-like">Polecane zabiegi</p>
        <div id="carousel-treatments" class="carousel slide" data-ride="carousel"> 
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php 
                    $i = 0;
                    while( $the_query->have_posts() ) : $the_query->the_post(); 
                ?>
                    <? if($i == 0 || $i%2 == 0): ?>
                        <li data-target="#carousel-treatments" data-slide-to="<? echo $i/2; ?>" <? if($i == 0): ?> class="active" <? endif; ?>></li>
                    <? 
                        endif; 
                        $i++;

                    ?>
                <?php endwhile; ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php 
                    $i = 0;
                    while( $the_query->have_posts() ) : $the_query->the_post(); 
                ?>
                    <? if($i == 0 || $i%2 == 0): ?>
                        <div class="item <? if($i == 0): ?> active <? endif; ?>">
                            <div class="row">
                    <? endif; ?>
    
                                <div class="col-md-6">
                                    <a class="nounderline" href="<? the_permalink(); ?>">
                                        <div class="card">
                                            <? if(has_post_thumbnail()) : ?>
                                                <img class="card-img-top" style="width:100%" src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title(); ?>">
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
                            
                    <? if($featured_count == 1 || $i%2 == 1): ?>
                            </div>
                        </div>
                    <? endif; ?>
                <?php 
                    $featured_count--;
                    $i++;
                    endwhile; 
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
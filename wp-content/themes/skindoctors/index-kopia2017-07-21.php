<?php get_header(); ?>
    <section class="carousel">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
            <!-- Indicators -->
            <!--
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol>
            -->
            <!-- Wrapper for slides -->
            <?php $loop = new WP_Query( array( 'post_type' => 'slides', 'posts_per_page' => -1 ) ); ?>
            <div class="carousel-inner" role="listbox">
                <?php 
                    $i = 0;
                    while ( $loop->have_posts() ) : $loop->the_post(); 
                ?>
                    <div class="item <?php if($i == 0) { ?>active<? } ?>">
                        <a href="<? the_field('link'); ?>">
                            <?php $i++; the_post_thumbnail( $size = 'full', $attr = '' ); ?>
                        </a>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Wstecz</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Dalej</span>
            </a>
        </div>
        <div class="container relative">
	        <div class="buttons">
	    		<div class="col-md-4 col-sm-4"><a href="<?php echo get_post_type_archive_link( 'special_offers' ); ?>" class="btn btn-lg btn-default btn-block">Oferty specjalne</a></div>
	    		<div class="col-md-4 col-sm-4"><a href="<?php echo get_post_type_archive_link( 'tips' ); ?>" class="btn btn-lg btn-default btn-block">Porady</a></div>
	    		<div class="col-md-4 col-sm-4"><a href="<?php echo get_term_link('filmy', 'mediacats'); ?>" class="btn btn-lg btn-default btn-block">Filmy</a></div>
	        </div>
        </div>
    </section>
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="center">
                        <h1><? echo get_the_title(151); ?></h1>
                        <div class="justify">
                            <? echo apply_filters('the_content', get_post_field('post_content', 151)); ?>
                        </div>
                        <?php 
                        $images = get_field('post_gallery', 151);
                        if( $images ): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                    <?php foreach( $images as $image ): ?>
                                        <div class="col-sm-3 col-xs-6 top30">
                                            <a href="<?php echo $image['url']; ?>" data-lightbox="gallery" data-title="<? echo get_the_title(151); ?>">
                                                 <img src="<?php echo $image['sizes']['thumbnail']; ?>" style="width: 100%;" alt="<?php echo $image['alt']; ?>" />
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <? include('menu_side.php'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php
        $args = array(
            'numberposts'   => 18,
            'posts_per_page' => 18,
            'post_type'     => ['treatments', 'tips'],
            'meta_key'      => 'if_featured',
            'meta_value'    => 1
        );

        // query
        $the_query = new WP_Query( $args );
    ?>
    <?php if( $the_query->have_posts() ): ?>
        <?php $featured_count = $the_query->post_count; ?>
        <section class="featured-treatments">
            <div class="container">
                <h3 class="center uppercase">Polecane zabiegi</h3>
                <div id="carousel-treatments" class="carousel slide" data-ride="carousel"> 
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php 
                            $i = 0;
                            while( $the_query->have_posts() ) : $the_query->the_post(); 
                        ?>
                            <? if($i == 0 || $i%3 == 0): ?>
                                <li data-target="#carousel-treatments" data-slide-to="<? echo $i/3; ?>" <? if($i == 0): ?> class="active" <? endif; ?>></li>
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
                            <? if($i == 0 || $i%3 == 0): ?>
                                <div class="item <? if($i == 0): ?> active <? endif; ?>">
                                    <div class="row">
                            <? endif; ?>
            
                                        <div class="col-md-4">
                                            <a class="nounderline" href="<? the_permalink(); ?>">
                                                <div class="card">
                                                    <? if(has_post_thumbnail()) : ?>
                                                        <div class="img">
                                                            <img class="card-img-top scale" data-scale="best-fill" data-align="center" style="width:100%" src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title(); ?>">
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
        </section>
    <?php endif; ?>
    <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

    <?php
        $args = array(
            'numberposts'   => -1,
            'post_type'     => 'recomendations'
        );

        // query
        $the_query = new WP_Query( $args );
    ?>
    <?php if( $the_query->have_posts() ): ?>
        <section class="recomendations">
            <div class="container relative">
                <a href="#" class="btn btn-default btn-skindoctor bottom20" data-toggle="modal" data-target="#Recomendation">
                    ZOSTAW<br><small>SWOJĄ OPINIĘ</small>
                </a>
                <div id="carousel-recomendations" data-interval="10000" class="carousel slide" data-ride="carousel"> 
                    <!-- Indicators -->
                    
                    <ol class="carousel-indicators">
                        <?php 
                            $i = 0;
                            while( $the_query->have_posts() ) : $the_query->the_post(); 
                        ?>
                            <li data-target="#carousel-recomendations" data-slide-to="<? echo $i; ?>" <? if($i == 0): ?> class="active" <? endif; ?>></li>
                            <? 
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
                            <div class="item <? if($i == 0): ?>active<? endif; ?>">
                                <div class="col-md-4">
                                    <div class="card">
                                        <? if(has_post_thumbnail() == true): ?>
                                            <img class="card-img-top" style="width:100%" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_field('name_surname'); ?>">
                                            <div class="card-block">
                                                <h4 class="card-title">
                                                    <span class="center">
                                                        <small>Polecam Preibisz ScinDoctors</small><br>
                                                        <i><?php the_field('name_surname'); ?></i>
                                                    </span>
                                                </h4>
                                            </div>
                                        <? else: ?>
                                            <div class="card-block" style="margin-top: 100px; top: 50px">
                                                <h4 class="card-title">
                                                    <span class="center">
                                                        <small>Polecam Preibisz ScinDoctors</small><br>
                                                        <i><?php the_field('name_surname'); ?></i>
                                                    </span>
                                                </h4>
                                            </div>
                                        <? endif;?>
                                    </div>
                                </div>
                                <div class="col-md-8 body">
                                    <div class="cont">
                                        <h3 class="uppercase">Rekomendacje</h3>
                                        <p class="quote">
                                            <i class="fa fa-quote-right"></i>
                                            <div class="single">
                                                <h4><?php the_field('name_surname'); ?></h4>
                                                <div class="content" >
                                                    <?php
                                                        echo wp_strip_all_tags(get_the_content());
                                                    ?>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <? 
                            $i++;
                            endwhile; 
                        ?>
                    </div>
                    <!-- Controls -->
                    <!--
                    <a class="left carousel-control" href="#carousel-recomendations" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Wstecz</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-recomendations" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Dalej</span>
                    </a>
                    -->
                </div>

            </div>
            <? include('modal.php'); ?>
        </section>
    <? endif; ?>

    <?php
        $args = array(
            'numberposts'   => 18,
            'posts_per_page' => 18,
            'post_type'     => 'news',
        );

        // query
        $the_query = new WP_Query( $args );
    ?>
    <?php if( $the_query->have_posts() ): ?>
        <?php $featured_count = $the_query->post_count; ?>
        <section class="news">
            <div class="container">
                <h3 class="center uppercase">Aktualności</h3>
                <div id="carousel-news" class="carousel slide" data-ride="carousel"> 
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php 
                            $i = 0;
                            while( $the_query->have_posts() ) : $the_query->the_post(); 
                        ?>
                            <? if($i == 0 || $i%3 == 0): ?>
                                <li data-target="#carousel-news" data-slide-to="<? echo $i/3; ?>" <? if($i == 0): ?> class="active" <? endif; ?>></li>
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
                            <? if($i == 0 || $i%3 == 0): ?>
                                <div class="item <? if($i == 0): ?> active <? endif; ?>">
                                    <div class="row">
                            <? endif; ?>
            
                                        <div class="col-md-4">
                                            <a class="nounderline" href="<? the_permalink(); ?>">
                                                <div class="card">
                                                    <? if(has_post_thumbnail()): ?>
                                                        <div class="img">
                                                            <img class="card-img-top scale" data-scale="best-fill" data-align="center" style="width:100%" src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title(); ?>">
                                                            <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                                                                <div class="play"></div>
                                                            <? endif; ?>
                                                        </div>
                                                    <? endif; ?>
                                                    <div class="card-block">
                                                        <h4 class="card-title black">
                                                            <?php the_title(); ?>
                                                        </h4>
                                                        <div class="clr"></div>
                                                        <p class="card-text justify">
                                                            <?php echo strlen(wp_strip_all_tags(get_the_content())) > 256 ? mb_substr(wp_strip_all_tags(get_the_content()),0,256).'...': wp_strip_all_tags(get_the_content()); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    
                            <? if($featured_count == 1 || $i%3 == 2): ?>
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
        </section>
    <?php endif; ?>
    <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

    
    <?php
        $args = array(
            'numberposts'   => 6,
            'post_type'     => 'media',
        );

        // query
        $the_query = new WP_Query( $args );
    ?>
    <?php if( $the_query->have_posts() ): ?>
        <?php $media_count = $the_query->post_count; ?>
        <section class="media">
            <h3 class="center uppercase">Media o nas</h3>
            <div class="container bottom30">
                <?php 
                    $i = 0;
                    while( $the_query->have_posts() ) : $the_query->the_post(); 
                ?>
                    <? if($i == 0): ?>
                        <div class="col-md-6">
                            <a class="nounderline" href="<? the_permalink(); ?>">
                                <div class="card">
                                    <div class="img">
                                        <img class="card-img-top scale" data-scale="best-fill" data-align="center" style="width:100%" src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<? the_title(); ?>">
                                        <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                                            <div class="play"></div>
                                        <? endif; ?>
                                    </div>
                                    <div class="card-block">
                                        <h4 class="card-title">
                                            <span>
                                            <? the_title(); ?>
                                            </span>
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <? endif; ?>
                    <? if($media_count > 0): ?>
                        <?php if($i == 1): ?>
                            <div class="col-md-6">
                        <? endif; ?>
                            <? if($media_count > 1  && $i == 1): ?>
                                <div class="row">
                            <? endif; ?>
                            <? if($i == 1 || $i == 2): ?>
                                <div class="col-md-6">
                                    <a class="nounderline" href="<? the_permalink(); ?>">
                                        <div class="card">
                                            <div class="img">
                                                <img class="card-img-top scale" data-scale="best-fill" data-align="center" style="width:100%" src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<? the_title(); ?>">
                                                <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                                                    <div class="play"></div>
                                                <? endif; ?>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="card-title">
                                                    <span>
                                                    <? the_title(); ?>
                                                    </span>
                                                </h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <? endif; ?>
                            <? if(($media_count == 1 && $i == 1) || $i == 2): ?>
                                </div>
                            <? endif; ?>

                            <? if($media_count > 0  && $i == 3): ?>
                                <div class="row top40">
                            <? endif; ?>
                            <? if($i == 3 || $i == 4 || $i == 5): ?>
                                <div class="col-md-4">
                                    <a class="nounderline" href="<? the_permalink(); ?>">
                                        <div class="card">
                                            <div class="img">
                                                <img class="card-img-top scale" data-scale="best-fill" data-align="center" style="width:100% !important;" src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<? the_title(); ?>">
                                                <? if(get_field('embedd_url') && get_field('embedd_url') != ""): ?>
                                                    <div class="play"></div>
                                                <? endif; ?>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="card-title">
                                                    <span>
                                                    <? the_title(); ?>
                                                    </span>
                                                </h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <? endif; ?>
                            <? if(($media_count == 1 && $i > 3)): ?>
                                </div>
                            <? endif; ?>

                        <?php if($media_count == 1 && $i > 0): ?>
                            </div>
                        <? endif; ?>
                    <? endif; ?>
                    <?php
                        $i++;
                        $media_count--;
                        endwhile;
                    ?>
                </div>
            </div>
        </section>
    <? endif; ?>
<?php get_footer(); ?>
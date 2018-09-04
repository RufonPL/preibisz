<?php get_header(); ?>

<div class="container top130">
	<div class="col-md-12">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<p>
				<?php the_content(); ?>
			</p>
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
	</div>
</div>

<?php get_footer(); ?>
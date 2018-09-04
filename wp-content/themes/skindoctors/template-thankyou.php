<?php /* Template Name: Formularz */ ?>

<?php get_header(); ?>

<div class="container top130">
	<div class="col-md-12 form">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<? if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "thankyou"): ?>
					<p>
						<?php the_field('thankyou'); ?>
					</p>
				<? else: ?>
					<p>
						<?php the_content(); ?>
					</p>
				<? endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>	
	</div>
</div>

<?php get_footer(); ?>
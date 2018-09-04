<?php /* Template Name: Kontakt */ ?>

<?php get_header(); ?>

<section style="padding:0px" class="relative">
	<div id="map">
	</div>
	<div class="col-md-4" id="contact-container" style="position: absolute; top: 0px; left: 0px; z-index:2;"">
		<div class="contact">
			<div>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<p>
						<?php the_content(); ?>
					</p>
				<?php endwhile; ?>
				<?php endif; ?>

				<? echo do_shortcode('[contact-form-7 id="129" title="Kontakt"]'); ?>		
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
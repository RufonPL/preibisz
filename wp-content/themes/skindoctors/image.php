<?php get_header(); ?>

<div class="container top130 bottom30">
	<div class="col-md-12">
		<a href="javascript:history.back();" class="btn btn-lg btn-default btn-skindoctor-dark">Wstecz</a>
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		?>
		                        <div class="entry-attachment">
		<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
		                        <p class="attachment"><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" width="100%" class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
		                        </p>
		<?php else : ?>
		                        <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
		<?php endif; ?>
		                        </div>

		<?php endwhile; ?>

		<?php endif; ?>
		<a href="javascript:history.back();" class="btn btn-lg btn-default btn-skindoctor-dark">Wstecz</a>
	</div>
</div>

<?php get_footer(); ?>
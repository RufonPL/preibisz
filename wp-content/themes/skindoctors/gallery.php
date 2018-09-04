<?php 
	$images = get_field('post_gallery');
	if( $images ): ?>
		<div class="row">
		    <div class="col-md-12">
				<div class="row">
		        <?php foreach( $images as $image ): ?>
		            <div class="col-sm-3 col-xs-6 top30">
		                <a href="<?php echo $image['url']; ?>" data-lightbox="gallery" data-title="<? the_title(); ?>">
		                     <img src="<?php echo $image['sizes']['thumbnail']; ?>" style="width: 100%;" alt="<?php echo $image['alt']; ?>" />
		                </a>
		            </div>
		        <?php endforeach; ?>
		        </div>
		    </div>
		</div>
	<?php endif; ?>
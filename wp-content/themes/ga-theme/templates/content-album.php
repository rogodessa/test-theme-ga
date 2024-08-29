	<div class="card">
		<?php if ( ! empty( get_post_thumbnail_id() ) ) : ?>
			<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'large', false, ['class' => 'card-img-top'] ) ?>
		<?php endif; ?>
		<div class="card-body">
			<h5 class="card-title"><?php the_title() ?></h5>
			<p class="card-text"><?php the_excerpt(); ?></p>
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">Go to Album</a>
		</div>
	</div>
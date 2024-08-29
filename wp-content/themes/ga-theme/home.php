<?php get_header(); ?>
    <div class="container">
        <div class="row">
            <h1><?php _e( 'Albums list', 'gatest' ) ?></h1>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
                    <div class="col col-md-6 col-xl-3">
						<?php get_template_part( 'templates/content', 'album' ); ?>
                    </div>
				<?php
				endwhile;
			endif;
			?>
        </div>
    </div>
<?php get_footer(); ?>
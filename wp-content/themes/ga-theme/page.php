<?php get_header(); ?>
    <div class="container">
        <div class="row justify-content-md-center">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
                    <div class="col col-md-8">
                        <h1><?php the_title() ?></h1>
                        <hr>
						<?php the_content(); ?>
                    </div>
				<?php
				endwhile;
			endif;
			?>
        </div>
    </div>
<?php get_footer(); ?>
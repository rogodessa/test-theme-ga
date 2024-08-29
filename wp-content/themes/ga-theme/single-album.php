<?php get_header(); ?>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-md-8 ">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						the_title( '<h1>', '</h1>' );
						?>
                        <hr>
                        <div class="d-flex gap-5 mt-4">
                            <div class="image">
								<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'full', false, [ 'class' => 'rounded d-block' ] ); ?>
                            </div>
                            <div class="content">
								<?php the_content(); ?>
                                <h4>Custom fields</h4>
                                <?php
                                    // TODO: It is better to move the code into a separate function.
                                    $meta = get_post_meta(get_the_ID());
                                    if(!empty($meta)) {
                                        echo '<ul class="list-group">';
                                        foreach($meta as $key => $item) {
                                            if(!str_starts_with($key, '_') && !empty($item[0])) {
                                                echo '<li class="list-group-item"><strong>'. $key .':</strong> '. $item[0] .'</li>';
                                            }
                                        }
                                        echo '</ul>';
                                    }
                                ?>
                            </div>
                        </div>
					<?php
					endwhile;
				endif;
				?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
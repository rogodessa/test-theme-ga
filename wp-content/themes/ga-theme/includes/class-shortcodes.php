<?php


class GaShortcodes {

	public function __construct() {

		add_shortcode( 'albums_list_1', [$this, 'shortcode_1'] );
		add_shortcode( 'albums_list_2', [$this, 'shortcode_2'] );

	}


	public function shortcode_1($atts) {
		$atts = shortcode_atts( array(
			'per_page'  => '-1',
		), $atts );

		$args = [
			'post_type' => 'album',
			'post_status' => 'publish',
			'posts_per_page' => $atts['per_page'],
			'meta_query' => [
				[
					'key' => 'Genre',
					'operator' => 'EXISTS',
				]
			]
		];

		$query = new WP_Query($args);

		$html = '';

		if ($query->have_posts()){

			$meta_values = [];

			$html .= '<div class="d-flex flex-column-reverse mb-5 genre-filter">';
			$html .= '<ol class="list-group list-group-numbered">';
			foreach ($query->posts as $key => $post) {
				$attachment_id = get_post_thumbnail_id($post->ID);

				$genre = get_post_meta($post->ID, 'Genre', true);

				$meta_values[] = $genre;

				$html .= '<li class="list-group-item d-flex justify-content-between align-items-center album-item" data-genre="'. esc_attr($genre) .'">';
					if(!empty($attachment_id)) {
						$html .= '<div class="mx-2" style="width: 50px">' . wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'thumbnail', false, ['class' => 'img-thumbnail'] ) . '</div>';
					}
					$html .= '<div class="ms-2 me-auto">';
						$html .= '<div class="fw-bold">'. $post->post_title .'</div>';
					$html .= '</div>';
				$html .= '</li>';
			}
			$html .= '</ol>';

			$meta_values = array_unique($meta_values);

			if(!empty($meta_values)) {
				$html .= '<select class="form-select genre-select mb-3 w-25" aria-label="Select genre">';
				$html .= '<option value="all" selected>All</option>';
				foreach ($meta_values as $value) {
					$html .= '<option value="'. esc_attr($value) .'">'. $value.'</option>';
				}
				$html .= '</select>';
			}

			$html .= '</div>';
		}

		return $html;
	}

	public function shortcode_2() {

		global $wpdb;

		$query = "
			SELECT p.ID, p.post_title, (SELECT COUNT(object_id) FROM {$wpdb->term_relationships} WHERE object_id = p.ID) as singles
			FROM {$wpdb->posts} as p
			WHERE p.post_type = '%s' AND p.post_status = '%s'
			GROUP BY p.ID
		";

		$results = $wpdb->get_results($wpdb->prepare($query,'album', 'publish'));

		$html = '';

		if(!empty($results)) {
			$html .= '<ol class="list-group list-group-numbered">';
			foreach($results as $key => $item) {
				$html .= '<li class="list-group-item d-flex justify-content-between align-items-start">';
					$html .= '<div class="ms-2 me-auto">';
						$html .= '<div class="fw-bold">'. $item->post_title .'</div>';
					$html .= '</div>';
					$html .= '<span class="badge text-bg-primary rounded-pill">'. $item->singles .'</span>';
				$html .= '</li>';
			}
			$html .= '</ol>';
		}

		return $html;

	}

}

new GaShortcodes();
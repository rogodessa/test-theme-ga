<?php

class GaThemeCPT {

	public function __construct() {

		add_action( 'init', [$this, 'create_album_cpt'] );
		add_action( 'init', [$this, 'create_taxonomy_singles'] );

	}

	/**
	 * Create WordPress CPT "Album"
	 * @return void
	 */
	function create_album_cpt() {
		register_post_type( 'album', [
			'label'  => __( 'Albums', 'gatest' ),
			'labels' => [
				'name'          => __( 'Albums', 'gatest' ),
				'singular_name' => __( 'Album', 'gatest' ),
				'menu_name'     => __( 'Albums', 'gatest' ),
				'all_items'     => __( 'Albums', 'gatest' ),
				'add_new'       => __( 'Add album', 'gatest' ),
				'add_new_item'  => __( 'Add album', 'gatest' ),
				'edit'          => __( 'Edit album', 'gatest' ),
				'edit_item'     => __( 'Edit album', 'gatest' ),
				'new_item'      => __( 'New album', 'gatest' )
			],
			'taxonomies'          => ['single'],
			'menu_icon'           => 'dashicons-album',
			'description'         => '',
			'menu_position'       => 6,
			'public'              => true,
			'show_ui'             => true,
			'publicly_queryable'  => true,
			'show_in_menu'        => true,
			'show_in_rest'        => false,
			'exclude_from_search' => false,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'rewrite'             => [
				'slug'          => 'albums',
			    'with_front'    => false
			],
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'supports'            => [ 'title', 'thumbnail', 'editor', 'custom-fields']
		] );
	}

	/**
	 * Create WordPress taxonomy "Single"
	 * @return void
	 */
	public function create_taxonomy_singles(){
		register_taxonomy('single', ['album'], [
			'labels' => [
				'name' => __('Single', 'gatest'),
				'singular_name' => __('Single', 'gatest'),
				'search_items' => __('Search single', 'gatest'),
				'all_items' => __('All singles', 'gatest'),
				'parent_item' => __('Parent single', 'gatest'),
				'edit_item' => __('Edit single', 'gatest'),
				'update_item' => __('Update single', 'gatest'),
				'add_new_item' => __('Add single', 'gatest'),
				'menu_name' => __('Singles', 'gatest')
			],
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'hierarchical' => true,
			'rewrite' => ['slug' => 'single'],
			'capabilities' => [],
			'show_admin_column' => true,
			'show_in_rest' => true,
			'rest_base' => null
		]);
	}

}

new GaThemeCPT();
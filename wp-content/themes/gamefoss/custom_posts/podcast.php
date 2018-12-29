<?php
// News Custom Post Type
function podcast() {

	$labels = array(
		'name'                  => _x( "Episódios", 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( "Episódio", 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( "Podcasts", 'text_domain' ),
		'name_admin_bar'        => __( "Podcasts", 'text_domain' ),
		'archives'              => __( 'Episódios', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'Todos os episódios', 'text_domain' ),
		'add_new_item'          => __( 'Novo Episódio', 'text_domain' ),
		'add_new'               => __( 'Adicionar Episódio', 'text_domain' ),
		'new_item'              => __( 'Novo', 'text_domain' ),
		'edit_item'             => __( 'Editar', 'text_domain' ),
		'update_item'           => __( 'Atualizar', 'text_domain' ),
		'view_item'             => __( 'Vizualizar', 'text_domain' ),
		'search_items'          => __( 'Pesquisar', 'text_domain' ),
		'not_found'             => __( 'Não encontrado', 'text_domain' ),
		'not_found_in_trash'    => __( 'Não encontrado', 'text_domain' ),
		'featured_image'        => __( 'Imagem em destaque', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remover imagem em destaque', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'podcasts',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Episódio', 'text_domain' ),
		'description'           => __( 'Episódio de Podcast', 'text_domain' ),
		'labels'                => $labels,
		'taxonomies'            => array( 'podcasts' ),
		'menu_icon'							=> 'dashicons-microphone',
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'supports'							=> array('title', 'editor', 'thumbnail', 'excerpt')
	);
	register_post_type( 'podcast', $args );
}
add_action( 'init', 'podcast' );

function create_podcast_podcasts() {
		$labels = array(
				'name'              => _x( 'Podcasts', 'taxonomy general name' ),
				'singular_name'     => _x( 'Podcast', 'taxonomy singular name' ),
				'search_items'      => __( 'Buscar Podcasts' ),
				'all_items'         => __( 'Todos os Podcasts' ),
				'edit_item'         => __( 'Editar Podcast' ),
				'update_item'       => __( 'Atualizar Podcast' ),
				'add_new_item'      => __( 'Adicionar Podcast' ),
				'new_item_name'     => __( 'Novo Nome de Podcast' ),
				'menu_name'         => __( 'Podcasts' ),
		);

		$args = array(
				'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
				'labels'            => $labels,
				'show_ui'           => true,
				'rewrite'           => array( 'slug' => 'podcast' )
		);

		register_taxonomy( 'podcasts', array( 'podcast' ), $args );
}
add_action( 'init', 'create_podcast_podcasts' );

function create_podcast_tags() {
	$labels = array(
			'name'              => _x( 'Tags (Podcast)', 'taxonomy general name' ),
			'singular_name'     => _x( 'Tags (Podcast)', 'taxonomy singular name' ),
			'search_items'      => __( 'Buscar Tags' ),
			'all_items'         => __( 'Todas as Tags' ),
			'edit_item'         => __( 'Editar Tag' ),
			'update_item'       => __( 'Atualizar Tag' ),
			'add_new_item'      => __( 'Adicionar Tag' ),
			'new_item_name'     => __( 'Novo Nome de Tag' ),
			'menu_name'         => __( 'Tags' ),
	);

	$args = array(
			'hierarchical'      => false, // Set this to 'false' for non-hierarchical taxonomy (like tags)
			'labels'            => $labels,
			'show_ui'           => true,
			'rewrite'           => array( 'slug' => 'tags' )
	);

	register_taxonomy( 'podcast_tags', array( 'podcast' ), $args );
}
add_action( 'init', 'create_podcast_tags' );
?>

<?php
// News Custom Post Type
function podcast() {

	$labels = array(
		'name'                  => _x( "Podcasts", 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( "Podcast", 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( "Podcasts", 'text_domain' ),
		'name_admin_bar'        => __( "Podcasts", 'text_domain' ),
		'archives'              => __( 'Arquivos', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'Podcasts', 'text_domain' ),
		'add_new_item'          => __( 'Novo Podcast', 'text_domain' ),
		'add_new'               => __( 'Novo Podcast', 'text_domain' ),
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
		'slug'                  => 'podcast',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Podcast', 'text_domain' ),
		'description'           => __( 'Podcast', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor'),
		'taxonomies'            => array( 'categorias' ),
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
		'supports'							=> array('title', 'editor', 'thumbnail')
	);
	register_post_type( 'podcast', $args );
}
add_action( 'init', 'podcast', 0 );

?>

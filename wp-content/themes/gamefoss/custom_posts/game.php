<?php
// News Custom Post Type
function game() {

	$labels = array(
		'name'                  => _x( __("[:pb]Jogos[:en]Games[:]"), 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( __("[:pb]Jogo[:en]Game[:]"), 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( __("[:pb]Jogos[:en]Games[:]"), 'text_domain' ),
		'name_admin_bar'        => __( __("[:pb]Jogos[:en]Games[:]"), 'text_domain' ),
		'archives'              => __( 'Arquivos', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'Jogos', 'text_domain' ),
		'add_new_item'          => __( 'Novo Jogo', 'text_domain' ),
		'add_new'               => __( 'Novo Jogo', 'text_domain' ),
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
		'slug'                  => 'game',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Game', 'text_domain' ),
		'description'           => __( 'Game', 'text_domain' ),
		'labels'                => $labels,
		'taxonomies'            => array( 'categorias' ),
		'menu_icon'							=> 'dashicons-heart',
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
	register_post_type( 'game', $args );
}
add_action( 'init', 'game', 0 );
function create_game_taxonomies() {
		$labels = array(
				'name'              => _x( 'Categorias (Game)', 'taxonomy general name' ),
				'singular_name'     => _x( 'Categoria (Game)', 'taxonomy singular name' ),
				'search_items'      => __( 'Buscar Categorias' ),
				'all_items'         => __( 'Todas as categorias' ),
				'edit_item'         => __( 'Editar Categoria' ),
				'update_item'       => __( 'Atualizar Categoria' ),
				'add_new_item'      => __( 'Adicionar Categoria' ),
				'new_item_name'     => __( 'Novo Nome de Categoria' ),
				'menu_name'         => __( 'Categorias' ),
		);

		$args = array(
				'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
				'labels'            => $labels,
				'show_ui'           => true,
				'rewrite'           => array( 'slug' => 'categorias' )
		);

		register_taxonomy( 'game_categories', array( 'game' ), $args );
}
add_action( 'init', 'create_game_taxonomies', 0 );

function create_game_tags() {
		$labels = array(
				'name'              => _x( 'Tags', 'taxonomy general name' ),
				'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
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

		register_taxonomy( 'game_tags', array( 'game' ), $args );
}
add_action( 'init', 'create_game_tags', 0 );
?>

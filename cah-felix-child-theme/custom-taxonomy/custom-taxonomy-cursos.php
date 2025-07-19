<?php

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => 'cursos',
		'singular_name'              => 'curso',
		'menu_name'                  => 'Cursos',
		'all_items'                  => 'Todos cursos',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'Novo curso',
		'add_new_item'               => 'Adicionar curso',
		'edit_item'                  => 'Editar curso',
		'update_item'                => 'Atualizar curso',
		'view_item'                  => 'Visualizar curso',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Buscar Curso',
		'not_found'                  => 'Not Found',
		'no_terms'                   => 'No items',
		'items_list'                 => 'Listar cursos',
		'items_list_navigation'      => 'Items list navigation',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'cursos', array( 'aulas' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );
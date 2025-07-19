<?php

/*
  Script Name: Aulas - Custom Fields Posts
  Description: Area reservada para criação de aulas"
  Author: Cah Felix
  Version: 0.1
*/

function aulas() {

	$labels = array(
		'name'                  => 'Aulas',
		'singular_name'         => 'aula',
		'menu_name'             => 'Aulas',
		'name_admin_bar'        => 'Aulas',
		'archives'              => 'Arquivo de aulas',
		'parent_item_colon'     => 'Parent Item:',
		'all_items'             => 'Todas aulas',
		'add_new_item'          => 'Adicionar nova aula',
		'add_new'               => 'Adicionar novo',
		'new_item'              => 'Nova aula',
		'edit_item'             => 'Editar aula',
		'update_item'           => 'Atualizar aula',
		'view_item'             => 'Visualizar aula',
		'search_items'          => 'Buscar aula',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Imagem destacada',
		'set_featured_image'    => 'Definir imagem de destaque',
		'remove_featured_image' => 'Remover imagem destacada',
		'use_featured_image'    => 'Use como uma imagem em destaque',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Items list',
		'items_list_navigation' => 'Items list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'aula',
		'description'           => 'Area reservada para criação de aulas',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( 'category', 'post_tag', ' cursos' ),
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
		'capability_type'       => 'page',
	);
	register_post_type( 'aulas', $args );

}
add_action( 'init', 'aulas', 0 );
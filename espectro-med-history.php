<?php
/*
*
Plugin Name: Historial Medico Espectro 
Description: Creates a custom post type and adds it to the WordPress menu.
Version 1.0
Author: Juan Garcia
*
*/

define("WP_ESPECTRO_DIR",plugin_dir_path(__FILE__));
require_once(WP_ESPECTRO_DIR . "connect-register.php");

 function custom_post_type()
{
    $labels = array(
        'name'               => 'Historiales Medicos',
        'singular_name'      => 'Historial Médico',
        'menu_name'          => 'Historiales Medicos',
        'name_admin_bar'     => 'Historial Médico',
        'add_new'            => 'Nuevo',
        'add_new_item'       => 'Agregar Historial Médico',
        'new_item'           => 'New Historial Médico',
        'edit_item'          => 'Editar Historial Médico',
        'view_item'          => 'Ver Historial Médico',
        'all_items'          => 'Todos los historiales médico',
        'search_items'       => 'Buscar Historiales Medicos',
        'parent_item_colon'  => 'Historiales Medicos Padres:',
        'not_found'          => 'No se han encontrado historiales',
        'not_found_in_trash' => 'No se han encontrado historiales en la papelera',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'med-history'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        "hierarchical"       => false,
        'menu_position'      => -1,
        'menu_icon' => 'dashicons-heart',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
    );

    register_post_type('custom_post', $args);
}

add_action('init', 'custom_post_type');


function add_custom_role()
{
    $capabilities = get_post_type_object('custom_post')->cap;
    add_role('medical_role', 'Médico', $capabilities);
}
add_action('init', 'add_custom_role');

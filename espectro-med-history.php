<?php
/*
*
Plugin Name: Espectro Amelia integraciones.
Description: Intregraciones de Amelia en espectro.cl
Version: 1.0
Author: Juan Garcia
*
*/

define("WP_ESPECTRO_DIR", plugin_dir_path(__file__));

require_once(WP_ESPECTRO_DIR . "helpers.php");


function med_history_type()
{

    $labels = array(
        'name'               => 'Historiales Medicos',
        'singular_name'      => 'Historial Médico',
        'menu_name'          => 'Historiales Medico',
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
        'capability_type' => 'post',
        'capabilities' => array(
            'edit_post' => 'edit_med_history',
            'read_post' => 'read_med_history',
            'delete_post' => 'delete_med_history',
            'edit_posts' => 'edit_med_histories',
            'edit_others_posts' => 'edit_others_med_histories',
            'publish_posts' => 'publish_med_histories',
            'read_private_posts' => 'read_private_med_histories',
        ),
        'has_archive'        => true,
        "hierarchical"       => false,
        'menu_position'      => -1,
        'menu_icon' => 'dashicons-heart',
        'supports'           => array('title', 'editor')
    );

    register_post_type('med_history', $args);

    $role = get_role('wpamelia-provider');
    if ($role) {
        $role->add_cap('edit_med_history');
        $role->add_cap('read_med_history');
        $role->add_cap('delete_med_history');
        $role->add_cap('edit_med_histories');
        $role->add_cap('edit_others_med_histories');
        $role->add_cap('publish_med_histories');
        $role->add_cap('read_private_med_histories');
    }
}

add_action('init', 'med_history_type');

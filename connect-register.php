<?php
add_action('wp_login', 'add_users_on_login', 10, 2);
function add_users_on_login($login, $user)
    global $wpdb;
    $user_id = $user->ID;
    $user_info = get_userdata($user_id);
    $user_email = $user_info->user_email;
    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);
    $phone_number = get_user_meta($user_id, 'phone_number', true);

    if (
        !in_array('administrator', $user->roles) &&
        !in_array('wpamelia-customer', $user->roles)
    ) {

        //Add Amelia user
        $wpdb->insert('wp_amelia_users', array(
            'firstName' => $first_name,
            'lastName' => $last_name,
            'email' => $user_email,
            'phone' => $phone_number,
            'type' => 'customer',
            'externalId' => $user_id,
        ), array('%s', '%s', '%s', '%s', '%s', '%d', '%s'));
    
}

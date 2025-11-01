<?php

function solarenergy_scripts() {
    wp_enqueue_style( 'solarenergy-style', get_stylesheet_uri() );
    wp_enqueue_script( 'solarenergy-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'solarenergy_scripts' );

function solarenergy_register_nav_menu() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'solarenergytheme' ),
    ) );
}
add_action( 'after_setup_theme', 'solarenergy_register_nav_menu' );

?>

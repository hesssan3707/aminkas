<?php

function solarenergy_setup() {
    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'solarenergy' ),
    ) );
}
add_action( 'after_setup_theme', 'solarenergy_setup' );

function solarenergy_scripts() {
    wp_enqueue_script( 'solarenergy-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'solarenergy_scripts' );

?>

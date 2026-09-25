<?php

function ccr946_setup() {

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    register_nav_menus( array(
        'primary' => 'Primary Menu',
    ) );
}

add_action( 'after_setup_theme', 'ccr946_setup' );


function ccr946_assets() {

    wp_enqueue_style(
        'ccr946-style',
        get_template_directory_uri() . '/assets/css/style.min.css',
        array(),
        '1.0'
    );
}

add_action( 'wp_enqueue_scripts', 'ccr946_assets' );
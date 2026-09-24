<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Theme setup
 */
function ccr946_setup() {

    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'ccr946' ),
    ) );
}

add_action( 'after_setup_theme', 'ccr946_setup' );


/**
 * Enqueue theme stylesheet
 */
function ccr946_enqueue_assets() {

    wp_enqueue_style(
        'ccr946-style',
        get_stylesheet_uri(),
        array(),
        '1.0.0'
    );

}

add_action( 'wp_enqueue_scripts', 'ccr946_enqueue_assets' );

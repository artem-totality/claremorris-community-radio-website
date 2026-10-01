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
        'ccr946-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'ccr946-style',
        get_template_directory_uri() . '/assets/css/style.min.css',
        array( 'ccr946-inter' ),
        '1.0'
    );

    wp_enqueue_script(
        'ccr946-schedule',
        get_template_directory_uri() . '/assets/js/schedule.js',
        array(),
        '1.0',
        true
    );

    wp_enqueue_script(
        'ccr946-onair',
        get_template_directory_uri() . '/assets/js/onair.js',
        array(),
        '1.0',
        true
    );
}

add_action( 'wp_enqueue_scripts', 'ccr946_assets' );

/**
 * Customizer – Social Links
 */
function ccr946_customize_register( $wp_customize ) {

    $wp_customize->add_section(
        'ccr946_social',
        array(
            'title'    => __( 'Social Links', 'ccr946' ),
            'priority' => 30,
        )
    );

    $wp_customize->add_setting(
        'ccr946_facebook_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'ccr946_facebook_url',
        array(
            'label'   => __( 'Facebook URL', 'ccr946' ),
            'section' => 'ccr946_social',
            'type'    => 'url',
        )
    );

    $wp_customize->add_setting(
        'ccr946_instagram_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'ccr946_instagram_url',
        array(
            'label'   => __( 'Instagram URL', 'ccr946' ),
            'section' => 'ccr946_social',
            'type'    => 'url',
        )
    );

    $wp_customize->add_setting(
        'ccr946_x_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'ccr946_x_url',
        array(
            'label'   => __( 'X / Twitter URL', 'ccr946' ),
            'section' => 'ccr946_social',
            'type'    => 'url',
        )
    );
}

add_action( 'customize_register', 'ccr946_customize_register' );
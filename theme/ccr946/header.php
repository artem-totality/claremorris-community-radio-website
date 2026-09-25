<!doctype html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="wrapper">

    <header class="header">

        <div class="header__inner">

            <div class="header__top">

                <div class="container">

                    <div class="header__top-inner">

                        <div class="logo">
                            <span class="logo__mark">CCR</span>
                            <span class="logo__freq">94.6 FM</span>
                        </div>

                        <nav class="nav">

                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'primary',
                                    'container'      => false,
                                    'menu_class'     => 'nav__list',
                                )
                            );
                            ?>

                        </nav>

                    </div>

                </div>

            </div>

            <div class="player">

                <div class="container">

                    <div class="player__inner">

                        <button
                            class="player__btn"
                            id="playBtn"
                            aria-label="Play live stream"
                            aria-pressed="false"
                        >
                            <span class="icon-play"></span>

                            <span class="icon-pause">
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <div class="player__meta">

                            <div class="status">
                                <span class="live-dot"></span>
                                LIVE · 94.6 FM
                            </div>

                            <div class="track">
                                <span class="artist">The Saw Doctors —</span>
                                N17
                            </div>

                        </div>

                        <div class="player__volume">

                            <span class="player-vol-icon">🔊</span>

                            <input
                                type="range"
                                id="volumeSlider"
                                min="0"
                                max="100"
                                value="80"
                                aria-label="Volume"
                            >

                        </div>

                        <!-- Replace the src below with CCR's real stream URL -->
                        <audio id="radioStream" preload="none">
                            <source
                                src="https://stream.example.com/ccr946.mp3"
                                type="audio/mpeg"
                            >
                        </audio>

                    </div>

                </div>

            </div>

        </div>

    </header>
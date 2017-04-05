<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package breaker
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <?php
    if( get_theme_mod( 'theme_header_bg' ) != '') { // if there is a background img
        $theme_header_bg = get_theme_mod('theme_header_bg'); // Assigning it to a variable to keep the markup clean
    }
    ?>
	<header id="masthead" class="site-header" role="banner" style="background: url('<?php echo $theme_header_bg ?>') center/cover no-repeat;">
        <div class="container">
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <button class="menu-toggle fa fa-navicon" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( '', 'breaker' ); ?></button>
                <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
            <div class="site-branding">
                <?php
                if ( is_front_page() ) : ?>
                    <h1 class="site-title"><?php the_custom_logo(); ?></h1>
                <?php else : ?>
                    <p class="site-title"><?php the_custom_logo(); ?></p>
                    <?php
                endif;

                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php
                endif; ?>
            </div><!-- .site-branding -->
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
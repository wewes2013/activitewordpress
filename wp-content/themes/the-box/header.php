<?php
/**
 * The template for displaying the header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package The Box
 * @since The Box 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>	
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
	
	<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Skip to content', 'the-box' ); ?></a>
	<header id="masthead" class="site-header clearfix">
		
		<div class="site-brand clearfix">
			<div class="row">
				<div class="col-6">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;
		
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div>
				<div class="col-6">
					<nav id="social-navigation" class="social-navigation">
						<?php thebox_social_links(); // Social Links ?>	
					</nav>
				</div>
			</div><!-- .row -->
		</div><!-- .site-brand -->
		
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle">
				<span class="screen-reader-text"><?php _e( 'open menu', 'the-box' ); ?></span>
				<span class="button-toggle"></span>
			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- .main-navigation -->
		
		<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) { ?>
				<a class="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
				</a>
		<?php } // Header Image ?>
		
	</header><!-- .site-header -->

	<div id="main" class="site-main clearfix">
		
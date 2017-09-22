<?php
/**
 * The Box functions and definitions
 *
 * @package The Box
 * @since The Box 1.0
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 */
if ( ! isset( $content_width ) )
	$content_width = 600; /* pixels */


/**
 * The Box Theme setup
 *
 */
if ( ! function_exists( 'thebox_setup' ) ) :

function thebox_setup() {
	
	// Make theme available for translation. Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'the-box', get_template_directory() . '/languages' );	
	
	// Supporting title tag via add_theme_support (since WordPress 4.1)
	add_theme_support( 'title-tag' );
   
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', thebox_fonts_url() ) );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Enable support for Post Thumbnail
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 940, 9999 ); //600 pixels wide (and unlimited height)
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'the-box' ),
		'secondary' => __( 'Footer Menu', 'the-box' )
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	// Custom template tags for this theme
	require get_template_directory() . '/inc/template-tags.php';
	
	// Theme Customizer
	require get_template_directory() . '/inc/customizer.php';
	
	// Set up the WordPress Custom Background Feature.
	add_theme_support( 'custom-background', apply_filters( 'thebox_custom_background_args', array(
		'default-color' => 'f0f3f5',
		'default-image' => '',
	) ) );
	
	// Load Jetpack compatibility file
	require get_template_directory() . '/inc/jetpack.php';
	
}
endif;
add_action( 'after_setup_theme', 'thebox_setup' );


if ( ! function_exists( 'thebox_fonts_url' ) ) :
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function thebox_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Source Sans Pro: on or off', 'the-box' ) ) {
		$fonts[] = 'Source Sans Pro:400,700,400italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Oxygen: on or off', 'the-box' ) ) {
		$fonts[] = 'Oxygen:400,700,300';
	}

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'the-box' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


/**
 * Enqueue scripts and styles for the front end.
 *
 */
function thebox_scripts() {
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'thebox-fonts', thebox_fonts_url(), array(), null );
	
	// Add Icons Font, used in the main stylesheet.
	wp_enqueue_style( 'thebox-icons', get_template_directory_uri() . '/fonts/fa-icons.css', array(), '1.7' );
		
	// Loads main stylesheet.
	wp_enqueue_style( 'thebox-style', get_stylesheet_uri(), array(), '1.4.7' );
	
	wp_enqueue_script( 'thebox-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20170220', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'thebox_scripts' );


/**
 * Enqueue Google fonts to admin screen.
 *
 */
function thebox_admin_fonts() {
	wp_enqueue_style( 'thebox-admin-fonts', thebox_fonts_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'thebox_admin_fonts' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 */
function thebox_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Primary', 'the-box' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div class="widget-wrapper"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',	
	) );
	register_sidebar( array(
		'name' => __( 'Footer', 'the-box' ),
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'thebox_widgets_init' );


/**
 * Implement the Custom Header feature
 *
 */
require( get_template_directory() . '/inc/custom-header.php' );


/**
 * Add Upsell "pro" link to the customizer
 *
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/customize-pro/class-customize.php' );


/*
 * Social Links
 *
 */
function thebox_social_links() {
	
	// Backward compatibility for Theme versions older than 4.1.3
	if ( get_option( 'thebox_theme_options' ) ) { // Retro compatibility for versions older than 4.1.3
		$options = get_option( 'thebox_theme_options', '' ); // Old Theme Options Page Values
		$facebook_url = get_option('facebook_url', $options['facebookurl'] );
		$twitter_url = get_option('twitter_url', $options['twitterurl'] );
		$googleplus_url = get_option('googleplus_url', $options['googleplusurl'] );
		$linkedin_url = get_option('linkedin_url', $options['linkedinurl'] );
		$instagram_url = get_option('instagram_url', $options['instagramurl'] );
		$youtube_url = get_option('youtube_url', $options['youtubeurl'] );
		$pinterest_url = get_option('pinterest_url', $options['pinteresturl'] );
		$stumbleupon_url = get_option('stumbleupon_url', $options['stumbleuponurl'] );
		$flickr_url = get_option('flickr_url', $options['flickrurl'] );
		$tumblr_url = get_option('tumblr_url', $options['tumblrurl'] );
		$medium_url = get_option('medium_url', $options['mediumurl'] );
		$github_url = get_option('github_url', $options['githuburl'] );
		
	} else {
		
		$facebook_url = get_option('facebook_url', '');
		$twitter_url = get_option('twitter_url', '');
		$googleplus_url = get_option('googleplus_url', '');
		$linkedin_url = get_option('linkedin_url', '');
		$instagram_url = get_option('instagram_url', '');
		$youtube_url = get_option('youtube_url', '');
		$pinterest_url = get_option('pinterest_url', '');
		$stumbleupon_url = get_option('stumbleupon_url', '');
		$flickr_url = get_option('flickr_url', '');
		$tumblr_url = get_option('tumblr_url', '');
		$medium_url = get_option('medium_url', '');
		$github_url = get_option('github_url', '');
	}
	
		$xing_url = get_option('xing_url', '');
	
	echo '<ul class="social-links">'; ?>
		
	<?php if ( $facebook_url != '' ) : ?>
		<li><a href="<?php echo $facebook_url; ?>" class="facebook" title="facebook" target="_blank"><span class="icon-facebook"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $twitter_url != '' ) : ?>
		<li><a href="<?php echo $twitter_url; ?>" class="twitter" title="twitter" target="_blank"><span class="icon-twitter"></span></a></li>
	<?php endif; ?>

	<?php if ( $googleplus_url != '' ) : ?>
		<li><a href="<?php echo $googleplus_url; ?>" class="googleplus" title="google plus" target="_blank"><span class="icon-googleplus"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $linkedin_url != '' ) : ?>
		<li><a href="<?php echo $linkedin_url; ?>" class="linkedin" title="instagram" target="_blank"><span class="icon-linkedin"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $instagram_url != '' ) : ?>
		<li><a href="<?php echo $instagram_url; ?>" class="instagram" title="instagram" target="_blank"><span class="icon-instagram"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $youtube_url != '' ) : ?>
		<li><a href="<?php echo $youtube_url; ?>" class="youtube" title="youtube" target="_blank"><span class="icon-youtube"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $pinterest_url != '' ) : ?>
		<li><a href="<?php echo $pinterest_url; ?>" class="pinterest" title="pinterest" target="_blank"><span class="icon-pinterest"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $stumbleupon_url != '' ) : ?>
		<li><a href="<?php echo $stumbleupon_url; ?>" class="stumbleupon" title="stumble upon" target="_blank"><span class="icon-stumbleupon"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $flickr_url != '' ) : ?>
		<li><a href="<?php echo $flickr_url; ?>" class="flickr" title="flickr" target="_blank"><span class="icon-flickr"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $tumblr_url != '' ) : ?>
		<li><a href="<?php echo $tumblr_url; ?>" class="tumblr" title="tumblr" target="_blank"><span class="icon-tumblr"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $medium_url != '' ) : ?>
		<li><a href="<?php echo $medium_url; ?>" class="medium" title="medium" target="_blank"><span class="icon-medium"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $github_url != '' ) : ?>
		<li><a href="<?php echo $github_url; ?>" class="github" title="github" target="_blank"><span class="icon-github"></span></a></li>
	<?php endif; ?>
	
	<?php if ( $xing_url != '' ) : ?>
		<li><a href="<?php echo $xing_url; ?>" class="xing" title="xing" target="_blank"><span class="icon-xing"></span></a></li>
	<?php endif; ?>
		
	<?php if ( get_option( 'thebox_show_rss', 1 ) ) : ?>
		<li><a href="<?php bloginfo( 'rss2_url' ); ?>" class="rss" title="rss" target="_blank"><span class="icon-rss"></span></a></li>
	<?php endif; ?>
	
	<?php echo '</ul>';
}


/**
 * Filter the except length to 18/40 characters.
 *
 */
function thebox_custom_excerpt_length( $length ) {
	if ( get_option( 'thebox_sidebar_settings' ) == 'grid2-sidebar' ) {
    return 18;
    } elseif ( get_option( 'thebox_sidebar_settings' ) == 'one-column') {
	return 50;
	} else {
	return 40;
    }
}
add_filter( 'excerpt_length', 'thebox_custom_excerpt_length', 999 );


/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function thebox_excerpt_more( $more ) {
    return sprintf( ' ... <a class="more-link" href="%1$s">%2$s &raquo;</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'the-box' )
    );
}
add_filter( 'excerpt_more', 'thebox_excerpt_more' );


/**
 * The Box Grid
 */
if ( !function_exists('thebox_grid') ) {
	function thebox_grid() {
		// Get Sidebar Options
		$layout_type = get_option( 'thebox_sidebar_settings', 'content-sidebar' );
		if ( $layout_type == 'grid2-sidebar' ) {
			echo 'col-6 col-sm-6';
		} else {
			echo 'col-12';
		}
	} 
}


/*
 * Prints Credits in the Footer
 *
 */
function thebox_credits() {	
	$website_credits = '';
	$website_author = get_bloginfo('name');
	$website_date =  date ('Y');
	$website_credits = '&copy; ' . $website_date . ' ' . $website_author;	
	echo esc_html( $website_credits );
}


/**
 * The Box Plus Notice
 *
 */
 if( is_admin() ) {

 	if( !get_option('thebox_basic_notice') ) {

    add_action('admin_notices', 'thebox_basic_notice');
    add_action('wp_ajax_thebox_hide_notice', 'thebox_hide_notice');

    function thebox_basic_notice(){
       ?>
      <div class="basic-notice updated is-dismissible" style="position: relative;padding-right: 40px;">
        <p>
          <?php
            printf(__('<strong>Upgrade to The Box Plus</strong> version to get extended functionality and advanced customization options: %1$s', 'the-box'),
            sprintf('<a class="button button-primary" style="text-decoration:none" href="http://www.designlabthemes.com/the-box-plus-wordpress-theme/" target="_blank">%s</a>', '<strong>Try The Box Plus</strong>')
            );
          ?>
        </p>
         <a class="notice-dismiss" style="text-decoration:none;cursor:pointer;" title="<?php _e('Close and don\'t show this message again', 'the-box'); ?>">
	         <span class="screen-reader-text">Dismiss this notice.</span>
         </a>         
      </div>

      <script type="text/javascript">
       jQuery(document).ready(function($){
         $('#wpbody').delegate('.basic-notice a.notice-dismiss', 'click', function(){
           $.ajax({
             url: ajaxurl,
             type: 'GET',
             context: this,
             data: ({
               action: 'thebox_hide_notice',
               _ajax_nonce: '<?php echo wp_create_nonce('thebox_hide_notice'); ?>'
             }),
             success: function(data){
               $(this).parents('.basic-notice').remove();
             }
           });
         });
       });

      </script>
      <?php
    }

    function thebox_hide_notice() {
      check_ajax_referer('thebox_hide_notice');
      update_option('thebox_basic_notice', true);
      die();
    }

  }

  // removes the notice status from the db
  add_action('switch_theme', 'thebox_remove_notice_record');

  function thebox_remove_notice_record(){
    delete_option('thebox_basic_notice');
  }

}

<?php
/**
 * Twenty Fourteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'footer'   => __( 'Footer menu', 'twentyfourteen' ),
		'footer1'   => __( 'Footer menu 1', 'twentyfourteen' ),
		'footer2'   => __( 'Footer menu 2', 'twentyfourteen' ),
		'footer3'   => __( 'Footer menu 3', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
        register_sidebar( array(
		'name'          => __( 'Header Search Sidebar', 'twentyfourteen' ),
		'id'            => 'header-search',
		'description'   => __( 'Appears in the Header section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Widget Area 1', 'twentyfourteen' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Widget Area 2', 'twentyfourteen' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Widget Area 3', 'twentyfourteen' ),
		'id'            => 'sidebar-6',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Widget Area 4', 'twentyfourteen' ),
		'id'            => 'sidebar-7',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Widget Area 5', 'twentyfourteen' ),
		'id'            => 'sidebar-8',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
        register_sidebar( array(
		'name'          => __( 'Footer Widget Area 6', 'twentyfourteen' ),
		'id'            => 'sidebar-9',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
        register_sidebar( array(
		'name'          => __( 'Category Price Slider', 'twentyfourteen' ),
		'id'            => 'sidebar-10',
		'description'   => __( 'Appears in the left sidebar section of category page.', 'twentyfourteen' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
		$query_args = array(
			'family' => urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style' ), '20131205' );
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'Jquery_ui_script', get_template_directory_uri() . '/js/jquery-ui.js', array( 'jquery' ) );
//        wp_enqueue_script( 'jq_paginate_script', get_template_directory_uri() . '/js/jquery.pagination.js', array( 'jquery' ) );
        wp_enqueue_script( 'paintOnline_main_js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );
        //wp_enqueue_script( 'paint_calculator', get_template_directory_uri() . '/js/calculator.js', array( 'jquery' ) );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
		wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
			'prevText' => __( 'Previous', 'twentyfourteen' ),
			'nextText' => __( 'Next', 'twentyfourteen' )
		) );
	}

	wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140616', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
			<div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		//$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}
function custom_numeric_posts_nav() {
    if( is_singular() )
        return;
    global $wp_query;
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    echo '<div class="product-nav">' . "\n";
    /**	Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '%s' . "\n", get_previous_posts_link('') );
    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<a href="%s">%s</a>' . "\n", esc_url( get_pagenum_link( 1 ) ), '1' );
        if ( ! in_array( 2, $links ) )
                echo '<li>…</li>';
    }
    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        if($paged == $link){
            printf( '<span %s>%s</span>' . "\n", $class, $link );
        }else{
            printf( '<a href="%s">%s</a>' . "\n", esc_url( get_pagenum_link( $link ) ), $link );
        }
        
    }
    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
            if ( ! in_array( $max - 1, $links ) )
                    echo '…' . "\n";

            $class = $paged == $max ? ' class="active"' : '';
            printf( '<a href="%s">%s</a></span>' . "\n", esc_url( get_pagenum_link( $max ) ), $max );
    }
    /**	Next Post Link */
    if ( get_next_posts_link() )
        printf( '%s' . "\n", get_next_posts_link('') );
    echo '</div>' . "\n";
}
add_filter('woocommerce_breadcrumb_defaults', 'paintOnline_breadcrums');
function paintOnline_breadcrums(){
    $args = array(
        'delimiter'   => '',
        'wrap_before' => '<div class="breadcrumb">',
        'wrap_after'  => '</div>',
        'before'      => '',
        'after'       => '',
        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
    );
    return $args;
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_filter('woocommerce_before_shop_loop', 'woocommerce_show_messages', 10, 2);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 20;' ), 20 ); 
//apply_filters( 'woocommerce_loop_add_to_cart_link', 'add_to_cart_link');
//function add_to_cart_link(){
//    global $product;
//    return sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
//        esc_url( $product->add_to_cart_url() ),
//        esc_attr( $product->id ),
//        esc_attr( $product->get_sku() ),
//        $product->is_purchasable() ? 'add_to_cart_button' : '',
//        esc_attr( $product->product_type ),
//        esc_html( $product->add_to_cart_text() ),$product );
//}
    
//add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );
//function custom_add_to_cart_redirect() {
//    return get_permalink( get_option('woocommerce_checkout_page_id') );
//}
add_filter('next_posts_link_attributes', 'posts_link_next_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_previous_attributes');

function posts_link_next_attributes() {
    return 'class="pro-nav-list last"';
}
function posts_link_previous_attributes() {
    return 'class="pro-nav-list first"';
}

function rc_woocommerce_recently_viewed_products() {
	// Get shortcode parameters
	extract(shortcode_atts(array(
		"per_page" => '3'
	), $atts));

	// Get WooCommerce Global
	global $woocommerce;

	// Get recently viewed product cookies data
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

	// If no data, quit
	if ( empty( $viewed_products ) )
		return __( 'You have not viewed any product yet!', 'rc_wc_rvp' );

	// Create the object
	ob_start();

	// Get products per page
	if( !isset( $per_page ) ? $number = 3 : $number = $per_page )

	// Create query arguments array
    $query_args = array(
        'posts_per_page' => $number, 
        'no_found_rows'  => 1, 
        'post_status'    => 'publish', 
        'post_type'      => 'product', 
        'post__in'       => $viewed_products, 
        'orderby'        => 'rand'
    );

	// Add meta_query to query args
	$query_args['meta_query'] = array();

    // Check products stock status
    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

	// Create a new query
	$r = new WP_Query($query_args);

	// If query return results
	if ( $r->have_posts() ) {
		$content = '';
		while ( $r->have_posts()) {
			$r->the_post();
			global $product;
                        $content .= '<div class="product-block">';
                        $content .= '<div class="inn-product">';
                        $content .= '<figure class="product-image">';
                        $content .= '<a href="'.get_the_permalink().'">';
                        $content .= woocommerce_get_product_thumbnail();
                        $content .= '</a>';
                        $content .= '</figure>';
                        $content .= '<div class="product-description">';
                        $content .= '<h4 class="product-title">'.get_the_title().'</h4>';
                        $content .= '<p class="product-text">'.substr($product->post->post_excerpt, 0, 50).'</p>';
                        if( $product->is_type( 'simple' ) ){
                            $content .= '<p class="product-price">'.strip_tags(woocommerce_price($product->regular_price)).'</p>';
                        } elseif( $product->is_type( 'variable' ) ){
                            $content .= '<p class="product-price">'.strip_tags(woocommerce_price($product->min_variation_price)).'</p>';
                        }
//                        $content .= '<div class="product-others">';
//                        $content .= '<span class="product-icon cart-icon sprite-icon"><a href="'.esc_url( $product->add_to_cart_url() ).'" rel="nofollow" data-product_id="'.esc_attr( $product->id ).'" data-product_sku="'.esc_attr( $product->get_sku() ).'">Add to Cart</a></span>';
//                        $content .= '<span class="product-icon view-icon sprite-icon"><a href="'.get_permalink( get_option('woocommerce_cart_page_id') ).'">View Cart</a></span>';
//                        $content .= '<span class="product-icon details-icon sprite-icon"><a href="'.get_the_permalink().'">Details</a></span>';
//                        $content .= '</div>';
                        $content .= '</div>';
                        if ( $product->is_on_sale() ) : 
                            $content .= apply_filters( 'woocommerce_sale_flash', '<span class="product-sale">' . __( 'Sale', 'woocommerce' ) . '</span>', $post, $product );
                        endif;
			$content .= '</div>';
			$content .= '</div>';
		}
	}
	// Get clean object
	$content .= ob_get_clean();
	// Return whole content
	return $content;
}
function paintOnline_feature_products(){
    $args = array(
        'post_type' => 'product',
        'meta_key' => '_featured',
        'meta_value' => 'yes',
        'posts_per_page' => -1
    );
    $content = '';
    $featured_query = new WP_Query( $args );
    if ($featured_query->have_posts()) : 
        $content .= '<div class="owl-carousel">';
        while ($featured_query->have_posts()) : 
            $featured_query->the_post();
            //global $product;
            $product = get_product( $featured_query->post->ID );
            //print_r($product);
            $content .= '<div class="feature-product-block">';
            $content .= '<div class="feature-product">';
            $content .= '<figure class="feature-product-image">';
            $content .= '<a href="'.get_the_permalink().'">';
            $content .= woocommerce_get_product_thumbnail();
            $content .= '</a>';
            $content .= '</figure>';
            $content .= '<div class="feature-product-description">';
            $content .= '<h4 class="feature-product-title">'.get_the_title().'</h4>';
            $content .= '<p class="feature-product-text">'.substr($product->post->post_excerpt, 0, 50).'</p>';
//            $content .= '<p class="feature-product-price">'.strip_tags(woocommerce_price($product->min_variation_price)).'</p>';
//            $content .= '<div class="frature-product-others">';
//            $content .= '<span class="product-icon cart-icon sprite-icon"><a href="'.esc_url( $product->add_to_cart_url() ).'" rel="nofollow" data-product_id="'.esc_attr( $product->id ).'" data-product_sku="'.esc_attr( $product->get_sku() ).'">Add to Cart</a></span>';
//            $content .= '<span class="product-icon view-icon sprite-icon"><a href="'.get_permalink( get_option('woocommerce_cart_page_id') ).'">View Cart</a></span>';
//            $content .= '<span class="product-icon details-icon sprite-icon"><a href="'.get_the_permalink().'">Details</a></span>';
//            $content .= '</div>';
            $content .= '</div>';
            if ( $product->is_on_sale() ) : 
                $content .= apply_filters( 'woocommerce_sale_flash', '<span class="product-sale">' . __( 'Sale', 'woocommerce' ) . '</span>', $post, $product );
            endif;
            $content .= '</div>';
            $content .= '</div>';
        endwhile;
        $content .= '</div>';
        else:
            $content .= '<p>No feature products found.</p>';
    endif;    
    wp_reset_query();
    //$content .= ob_get_clean();
    // Return whole content
    return $content;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); // Remove the additional information tab
    return $tabs;
}
function comment_validation_init() {
    if(is_single()) { ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#commentform').validate({		 
                    rules: {
                      author: {
                            required: true,
                            minlength: 2
                      },				 
                      email: {
                            required: true,
                            email: true
                      },				 
                      comment: {
                            required: true,
                            minlength: 20
                      }
                    },		 
                    messages: {
                      author: "Please enter in your name.",
                      email: "Please enter a valid email address.",
                      comment: "Please enter message at least 20 characters."
                    },		 
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                            element.before(error);
                    }

            });
        });
        </script>
    <?php
    }
}
add_action('wp_footer', 'comment_validation_init');
//add_filter( 'woocommerce_variable_sale_price_html', 'paintonline_variation_price_format', 10, 2 );
//add_filter( 'woocommerce_variable_price_html', 'paintonline_variation_price_format', 10, 2 );
//function paintonline_variation_price_format( $price, $product ) {
//    return $product->get_variation_price( 'min', true );
//}
add_action( 'init', 'paintOnlines_post_types_and_taxonomies' );
function paintOnlines_post_types_and_taxonomies() {
    register_post_type('colors',
            array(
                'public' => true,
                'label'  => 'Manage Colors',
                'rewrite' => array("slug" => "colors"),
                'supports' => array('title')
            )
    );
    flush_rewrite_rules();
    register_taxonomy(
                'color-categories',
                array('colors', 'product'),
                array(
                        'label' => __( 'Color Categories' ),
                        'rewrite' => array( 'slug' => 'color-categories' ),
                        'hierarchical' => true,
                )
    );
    flush_rewrite_rules();
    register_post_type('sliders',
            array(
                'public' => true,
                'label'  => 'Sliders',
                'rewrite' => array("slug" => "sliders"),
                'supports' => array('title', 'thumbnail', 'editor')
            )
    );
    flush_rewrite_rules();
}
function autocomplete_color_lists(){
    global $post;
    $color_cat_lists = array();
    $term_lists = wp_get_post_terms($post->ID, 'color-categories', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
//    echo '<pre>';
//    print_r($term_lists);
    if(!empty($term_lists)){
        foreach ($term_lists as $term) {
            if($term->parent == '0'){
                continue;
            }
            array_push($color_cat_lists, array("id"=>$term->term_id, "label"=>$term->name, "value" => $term->name));
        }
    }else{
        array_push($color_cat_lists, array("id"=>0, "label"=>'No color has been associated with this product', "value" => 0));
    }
    return $color_cat_lists;
}
function get_colors(){
    $cat_id = $_REQUEST['cat_id'];
    $term = get_term( $cat_id, 'color-categories' );
    query_posts("taxonomy=color-categories&post_type=colors&color-categories={$term->slug}");  
    $design = '';
    if(have_posts()){
        while(have_posts()){ the_post();
            $id = get_the_ID();
            $all_colors = get_field('colors');
            $design .= '<ul class="color_palet_dynamic" id="dynamic_color">';
            foreach($all_colors as $color){
                $design .= '<li style="background-color:'.$color['color_picker'].'"><a href="javascript:void(0)" data-color="'.$color['color_picker'].'" title="'.$color['color_name'].'"></a></li>';
            }
            $design .= '</ul>';
        }
        wp_reset_query();
    }else{
            $design .= 'No color has been associated';
    }
    echo json_encode(array('color_html' => $design));
    die();
}
add_action( 'wp_ajax_get_colors', 'get_colors' );
add_action( 'wp_ajax_nopriv_get_colors', 'get_colors' );
function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
    if ( $attach_id ) {
        $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
        $file_path = get_attached_file( $attach_id );
    } else if ( $img_url ) {
        $file_path = parse_url( $img_url );
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
        if(file_exists($file_path) === false){
            global $blog_id;
            $file_path = parse_url( $img_url );
            if (preg_match("/files/", $file_path['path'])) {
                $path = explode('/',$file_path['path']);
                foreach($path as $k=>$v){
                    if($v == 'files'){
                        $path[$k-1] = 'wp-content/blogs.dir/'.$blog_id;
                    }
                }
                $path = implode('/',$path);
            }
            $file_path = $_SERVER['DOCUMENT_ROOT'].$path;
        }
        $orig_size = getimagesize( $file_path );
        $image_src[0] = $img_url;
        $image_src[1] = $orig_size[0];
        $image_src[2] = $orig_size[1];
    }
    $file_info = pathinfo( $file_path );
    $base_file = $file_info['dirname'].'/'.$file_info['filename'].'.'.$file_info['extension'];
    if ( !file_exists($base_file) )
    return;
    $extension = '.'. $file_info['extension'];
    $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
    $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
    if ( $image_src[1] > $width ) {
        if ( file_exists( $cropped_img_path ) ) {
            $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
            $vt_image = array (
                'url' => $cropped_img_url,
                'width' => $width,
                'height' => $height
            );
            return $vt_image;
        }
        if ( $crop == false OR !$height ) {
            $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
            $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;
            if ( file_exists( $resized_img_path ) ) {
                $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
                $vt_image = array (
                'url' => $resized_img_url,
                'width' => $proportional_size[0],
                'height' => $proportional_size[1]
                );
                return $vt_image;
            }
        }
        $img_size = getimagesize( $file_path );
        if ( $img_size[0] <= $width ) $width = $img_size[0];
        if (!function_exists ('imagecreatetruecolor')) {
            echo 'GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
            return;
        }
        $new_img_path = image_resize( $file_path, $width, $height, $crop );	
        $new_img_size = getimagesize( $new_img_path );
        $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
        $vt_image = array (
            'url' => $new_img,
            'width' => $new_img_size[0],
            'height' => $new_img_size[1]
        );
        return $vt_image;
    }
    $vt_image = array (
        'url' => $image_src[0],
        'width' => $width,
        'height' => $height
    );
    return $vt_image;
}
add_action( 'init', 'setsession',1);
function setsession() {
	session_start();
}
function get_variation_price(){
    global $woocommerce;
    $variation_id = $_REQUEST['variation_id'];
    $product_variation = new WC_Product_Variation($variation_id);
    $_SESSION['color_name'] = $_REQUEST['color_name'];
    $_SESSION['color_price'] = $_REQUEST['color_price'];
    if($_REQUEST['no_color'] == '1'){
        unset($_SESSION['color_name']);
        unset($_SESSION['color_price']);
        echo json_encode(array('price' => str_replace('&#36;', '$', strip_tags(woocommerce_price($product_variation->regular_price)))));
        die();
    }
    echo json_encode(array('price' => str_replace('&#36;', '$', strip_tags(woocommerce_price($product_variation->regular_price + 0)))));
    die();
}
add_action( 'wp_ajax_get_variation_price', 'get_variation_price' );
add_action( 'wp_ajax_nopriv_get_variation_price', 'get_variation_price' );

function add_cart_item_custom_data( $cart_item_meta, $product_id ) {
    global $woocommerce;
    $cart_item_meta['color_name'] = $_SESSION['color_name'];
    $cart_item_meta['color_price'] = $_SESSION['color_price'];
    unset($_SESSION['color_name']);
    unset($_SESSION['color_price']);
    return $cart_item_meta; 
}
add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_custom_data', 10, 2 );
function get_cart_items_from_session( $item, $values, $key ) {
    if ( array_key_exists( 'color_name', $values ) ){
        $item[ 'color_name' ] = $values['color_name'];
        $item[ 'color_price' ] = $values['color_price'];
    }	
    return $item;
}
add_filter( 'woocommerce_get_cart_item_from_session', 'get_cart_items_from_session', 1, 3 );
function woo_add_extravalues() {
    global $woocommerce;
	$addfee = 0;
	$attr_names = '';
	//print "<pre>";print_r(WC()->cart->get_cart());
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		//$addfee += $cart_item['color_price'];
//		if(!empty($cart_item['attr_names'])){
//			$attr_names .= get_the_title($cart_item['product_id']).': '.$cart_item['attr_names'] . ', '; 
//		}
		if(!empty($cart_item['color_price'])){
                    $cart_item['data']->set_price($cart_item['data']->price + $cart_item['color_price']);
		}
		
	}
	
	/*$additional_fee_title = 'Additional Fee ('.$attr_names.')';*/
//	$additional_fee_title = 'Other Charges/Customization';

//	$woocommerce->cart->add_fee( $additional_fee_title, $addfee, $taxable = false, $tax_class = '' );
	//$woocommerce->cart->add_fee( 'Test', '100', $taxable = false, $tax_class = '' );
//	$woocommerce->cart->add_fee( 'Additional Distance Fee', $_SESSION['shipping_cost'], $taxable = false, $tax_class = '' );
}
add_action( 'woocommerce_before_calculate_totals', 'woo_add_extravalues');

if(!function_exists('wdm_add_values_to_order_item_meta'))
{
  function wdm_add_values_to_order_item_meta($item_id, $values)
  {
        global $woocommerce,$wpdb;
        $color_name = $values['color_name'];
        /*$post_code = $values['post_code'];*/
//        $attr_names = $values['attr_names'];
        if(!empty($color_name))
        {
            wc_add_order_item_meta($item_id,'Color Name',$color_name);
            /*wc_add_order_item_meta($item_id,'Post Code',$post_code);	*/		
//            wc_add_order_item_meta($item_id,'Additional Services',$attr_names);  
        }
  }
} 
add_action('woocommerce_add_order_item_meta','wdm_add_values_to_order_item_meta',1,2);
function result_count(){
    global $wp_query;
?>
<span class="total-product-display">
	<?php
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $wp_query->found_posts;
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

	if ( 1 == $total ) {
		_e( 'Showing the single result' );
	} elseif ( $total <= $per_page || -1 == $per_page ) {
		printf( __( 'Showing all %d results'), $total );
	} else {
		printf( _x( 'Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total'), $first, $last, $total );
	}
	?>
</span>
<?php        
}
function get_total_color($taxonomy){
    query_posts(array('taxonomy' => 'color-categories', 'post_type' => 'colors', 'color-categories' => $taxonomy));
    $count = 0;
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            $all_colors = get_field('colors');
            if(!empty($all_colors) && is_array($all_colors)):
                $count += count($all_colors);
            endif;
        endwhile;
        wp_reset_query();        
    endif;
    return $count;
}
//add_filter( 'woocommerce_get_price_html', 'paintOnline_price_html', 100, 2 );
function paintOnline_price_html(){
    global $product;
    return strip_tags($product->get_price_html());
}
function woo_related_products_limit() {
    global $product;
    $args['posts_per_page'] = 4;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'woo_related_products_limit' ); 
add_action('admin_menu','wphidenag');
function wphidenag() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php header_image(); ?>);
            padding-bottom: 30px;
            background-size: 277px 115px;
            width:277px;
            height:115px;
        }
    </style>
<?php }
add_action( 'login_head', 'my_login_logo' );
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Paint Online';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
function my_footer_shh() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
}
add_action( 'admin_menu', 'my_footer_shh' );
function my_footer_text() {
	echo '';
}
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
    if('sliders' == get_post_type()){
        return $content .= '<p>Best resolution would be 530 X 450 and in transparent background (.png extension).</p>';
    }else{
        return $content;
    }
}

function get_wishlist_count(){
    $count = yith_wcwl_count_products();
    echo $count;
    die();
}
add_action( 'wp_ajax_get_wishlist_count', 'get_wishlist_count' );
add_action( 'wp_ajax_nopriv_get_wishlist_count', 'get_wishlist_count' );
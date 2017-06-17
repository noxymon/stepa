<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
        
        function footer_enqueue_scripts() {
            remove_action('wp_head', 'print_emoji_detection_script');
            remove_action('wp_head', 'wp_print_scripts');
            remove_action('wp_head', 'wp_print_head_scripts', 9);
            remove_action('wp_head', 'wp_enqueue_scripts', 1);
            add_action('wp_footer', 'print_emoji_detection_script', 5);
            add_action('wp_footer', 'wp_print_scripts', 5);
            add_action('wp_footer', 'wp_enqueue_scripts', 5);
            add_action('wp_footer', 'wp_print_head_scripts', 5);
        }
        add_action('wp_head', 'footer_enqueue_scripts');
        
//	// Options Framework (https://github.com/devinsays/options-framework-plugin)
//	if ( !function_exists( 'optionsframework_init' ) ) {
//		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/' );
//		require_once dirname( __FILE__ ) . '/_/inc/options-framework.php';
//	}

	// Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_setup() {
		load_theme_textdomain( 'html5reset', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status' ) );
		register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );
		add_theme_support( 'post-thumbnails' );
	}
	add_action( 'after_setup_theme', 'html5reset_setup' );

	// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_scripts_styles() {
		global $wp_styles;
		// Load Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	}
	add_action( 'wp_enqueue_scripts', 'html5reset_scripts_styles' );

	// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

//		 Add the site name.
		$title .= get_bloginfo( 'name' );

//		 Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
//		 Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'html5reset' ), max( $paged, $page ) );
		return $title;
	}
	add_filter( 'wp_title', 'html5reset_wp_title', 10, 2 );

        // Load jQuery
        if (!function_exists('core_mods')) {
            function core_mods() {
                if (!is_admin()) {
                    wp_deregister_script('jquery');
                    wp_register_script('jquery', (get_template_directory_uri() . '/vendor/js/jquery.js'), false);
                    wp_enqueue_script('jquery');

                    wp_deregister_script('bootstrap');
                    wp_register_script('bootstrap', (get_template_directory_uri() . '/vendor/js/bootstrap.min.js'), false);
                    wp_enqueue_script('bootstrap');
                }
            }
            add_action('wp_footer', 'core_mods');
        }
	// Custom Menu
	register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );

	// Widgets
	if ( function_exists('register_sidebar' )) {
            function html5reset_widgets_init() {
                register_sidebar( array(
                        'name'          => __( 'Sidebar Widgets', 'html5reset' ),
                        'id'            => 'sidebar-primary',
                        'before_widget' => '<div class="well"><div id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</div></div>',
                        'before_title'  => '<h4 class="widget-title">',
                        'after_title'   => '</h4>',
                ) );
            }
            add_action( 'widgets_init', 'html5reset_widgets_init' );
	}

	// Navigation - update coming from twentythirteen
	function post_navigation() {
            echo '<ul class="pager">
                    <li class="previous">
                        '.get_next_posts_link("← Older").'
                    </li>
                    <li class="next">
                        '.get_previous_posts_link("Newer →").'
                    </li>
                </ul>';
	}

	// Posted On
	function posted_on() {
            printf( __( '<span class="glyphicon glyphicon-time"></span> <span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
                esc_url( get_permalink() ),
                esc_attr( get_the_time() ),
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_author() )
            );
	}
        
        if (is_admin_bar_showing()) {
            function move_navbar(){ ?>
                <style type="text/css">
                    .navbar-fixed-top {
                        top: 32px;
                    }
                </style>
            <?php }
            add_action('wp_head', 'move_navbar');
        }
        
        function modify_read_more_link() {
            return '<a class="btn btn-primary more-link" href="' . get_permalink() . '">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>';
        }
        add_filter('the_content_more_link', 'modify_read_more_link');
?>

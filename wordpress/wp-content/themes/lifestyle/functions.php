<?php
/**
 * Lifestyle functions and definitions
 *
 * @package Lifestyle
 */

function lifestyle_setup() {

	remove_action( 'omega_before_header', 'omega_get_primary_menu' );	
	add_action( 'omega_after_header', 'omega_get_primary_menu' );

	add_theme_support( 'plugin-activation' );

	/* Add support for a custom header image. */
	add_theme_support(
		'custom-header',
		array( 'header-text' => false,
			'flex-width'    => true,
			'uploads'       => true,
			'default-image' => get_stylesheet_directory_uri() . '/images/header.jpg' 
			));



	add_theme_support( 'color-palette', array( 'callback' => 'lifestyle_register_colors' ) );

	add_filter( 'loop_pagination_args', 'lifestyle_loop_pagination_args' );

	remove_action( 'omega_home_before_entry', 'omega_entry_header' );

	add_action( 'omega_after_header', 'lifestyle_banner' );

	add_action('init', 'lifestyle_init', 1);

	add_theme_support( 'omega-footer-widgets', 3 );

	add_action( 'widgets_init', 'lifestyle_widgets_init', 15 );

}

add_action( 'after_setup_theme', 'lifestyle_setup', 11  );

function lifestyle_loop_pagination_args( $args ) {
	/* Set up some default arguments for the paginate_links() function. */
	$args = array(
		'end_size'     => 5,
		'mid_size'     => 4
	);
	return $args;
}

/**
 * Register widgetized area and update sidebar with default widgets
 */
function lifestyle_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Home Banner', 'lifestyle' ),
		'id'            => 'banner',
		'description'   => 'This widget area will replace the homepage header image',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}

function lifestyle_get_home_banner() {
	if ( is_active_sidebar( 'banner' ) ) {
		 dynamic_sidebar( 'banner' );
	} else {
    echo do_shortcode("[metaslider id=31]"); 
		
	}
}

function lifestyle_get_header_image() {
	if (get_header_image() && is_front_page()) {
		if ( is_active_sidebar( 'banner' ) ) {
			 dynamic_sidebar( 'banner' );
		} else {
			if (get_theme_mod( 'lifestyle_header_link' )) {
				echo '<a href="'. esc_url( get_theme_mod( 'lifestyle_header_link' ) ) .'"><img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="' . esc_attr( get_bloginfo( 'description' ) ) . '" /></a>';
			} else {
				echo '<img class="header-image" src="' . esc_url( get_header_image() ) . '" alt="' . esc_attr( get_bloginfo( 'description' ) ) . '" />';
			}
		}
	}
}

function lifestyle_banner() {
	
?>
	<div class="banner">
		<div class="wrap">
			<?php
			if(is_front_page()) {
				lifestyle_get_home_banner();
			} elseif ( !is_front_page() && get_theme_mod( 'lifestyle_header_home' ) ) {
					echo '';
			} else {	
				// get title		
				$id = get_option('page_for_posts');

				if(is_home() || is_singular('post' ) ) {
					if ( has_post_thumbnail($id) ) {
						echo get_the_post_thumbnail( $id, 'full' );
					} 
				} elseif ( has_post_thumbnail() && is_singular('page' ) ) {	
						the_post_thumbnail();
				}
			}
			?>
		</div><!-- .wrap -->
  	</div><!-- .banner -->
<?php  	
}

/**
 * Registers colors for the Color Palette extension.
 *
 * @since  0.1.0
 * @access public
 * @param  object  $color_palette
 * @return void
 */

function lifestyle_register_colors( $color_palette ) {

	/* Add custom colors. */
	$color_palette->add_color(
		array( 'id' => 'primary', 'label' => __( 'Primary Color', 'lifestyle' ), 'default' => '232323' )
	);
	$color_palette->add_color(
		array( 'id' => 'link', 'label' => __( 'Link Color', 'lifestyle' ), 'default' => '858585' )
	);

	/* Add rule sets for colors. */

	$color_palette->add_rule_set(
		'primary',
		array(
			'color'               => 'h1.site-title a, .site-description, .entry-meta',
			'background-color'    => '.tinynav, input[type="button"], input[type="reset"], input[type="submit"]'
		)
	);
	$color_palette->add_rule_set(
		'link',
		array(
			'color'    => '.site-inner .entry-meta a, .site-inner .entry-content a, .site-inner .sidebar a'
		)
	);
}

function lifestyle_init() {
	if(!is_admin()){
		wp_enqueue_script("tinynav", get_stylesheet_directory_uri() . '/js/tinynav.js', array('jquery'));
        //swp_enqueue_script("full_slider", get_stylesheet_directory_uri() . '/js/full_slider.js', array('jquery'));
	} 
}

add_action( 'tgmpa_register', 'lifestyle_register_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function lifestyle_register_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name' 		=> 'Master Slider - Responsive Touch Slider',
			'slug' 		=> 'master-slider',
			'required' 	=> false,
		),

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'lifestyle' ),
			'menu_title'                       			=> __( 'Install Plugins', 'lifestyle' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'lifestyle' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'lifestyle' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'lifestyle' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'lifestyle' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'lifestyle' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'lifestyle' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'lifestyle' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'lifestyle' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'lifestyle' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'lifestyle' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'lifestyle' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'lifestyle' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'lifestyle' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'lifestyle' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'lifestyle' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	if (function_exists('tgmpa')) {
		tgmpa( $plugins, $config );
	}

}

?>
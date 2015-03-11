<?php
function scripts_and_styles_method() {

  $templateuri = get_template_directory_uri() . '/js/';

  // library.js is to bundle plugins. my.js is your scripts. enqueue more files as needed
  $jslib = $templateuri."library.js";
  wp_enqueue_script( 'jslib', $jslib,'','',true);
  $myscripts = $templateuri."main.js";
  wp_enqueue_script( 'myscripts', $myscripts,'','',true);

  // enqueue stylesheet here. file does not exist until stylus file is processed
  wp_enqueue_style( 'site', get_stylesheet_directory_uri() . '/css/site.css' );

  // dashicons for admin
  if(is_admin()){
    wp_enqueue_style( 'dashicons' );
  }

}
add_action('wp_enqueue_scripts', 'scripts_and_styles_method');

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );

  add_image_size( 'icon', 400, 400, true );
}

// Register Custom Taxonomy: Artists
function artist_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Artists', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Artist', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Artists', 'text_domain' ),
    'all_items'                  => __( 'All Artists', 'text_domain' ),
    'parent_item'                => __( 'Parent Artist', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Artist:', 'text_domain' ),
    'new_item_name'              => __( 'New Artist Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Artist', 'text_domain' ),
    'edit_item'                  => __( 'Edit Artist', 'text_domain' ),
    'update_item'                => __( 'Update Artist', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate artist with commas', 'text_domain' ),
    'search_items'               => __( 'Search Artist', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove artists', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used artist', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                       => 'artist',
    'with_front'                 => true,
    'hierarchical'               => false,
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'artist', array( 'post' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'artist_taxonomy', 0 );

// Register Nav Menus
/*
register_nav_menus( array(
	'menu_location' => 'Location Name',
) );
*/

get_template_part( 'lib/gallery' );
get_template_part( 'lib/post-types' );
get_template_part( 'lib/meta-boxes' );

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
function cmb_initialize_cmb_meta_boxes() {
  // Add CMB2 plugin
  if( ! class_exists( 'cmb2_bootstrap_202' ) )
    require_once 'lib/CMB2/init.php';
}

// Disable that freaking admin bar
add_filter('show_admin_bar', '__return_false');

// Turn off version in meta
function no_generator() { return ''; }
add_filter( 'the_generator', 'no_generator' );

// Show thumbnails in admin lists
add_filter('manage_posts_columns', 'new_add_post_thumbnail_column');
function new_add_post_thumbnail_column($cols){
  $cols['new_post_thumb'] = __('Thumbnail');
  return $cols;
}
add_action('manage_posts_custom_column', 'new_display_post_thumbnail_column', 5, 2);
function new_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'new_post_thumb':
    if( function_exists('the_post_thumbnail') ) {
      echo the_post_thumbnail( 'admin-thumb' );
      }
    else
    echo 'Not supported in theme';
    break;
  }
}

// remove automatic <a> links from images in blog
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

// custom login logo
/*
function custom_login_logo() {
  echo '<style type="text/css">h1 a { background-image:url(' . get_bloginfo( 'template_directory' ) . '/images/login-logo.png) !important; background-size:300px auto !important; width:300px !important; }</style>';
}
add_action( 'login_head', 'custom_login_logo' );
*/

function get_domain($url)
{
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return false;
}


// Filter video output
add_filter('oembed_result','oembed_result_args', 10, 3);
function oembed_result_args($html, $url, $args) {
  // $args includes custom argument
  $newargs = $args;
  // get rid of discover=true argument
  //array_pop( $newargs );
  $parameters = http_build_query($newargs);

  $domain = get_domain($url);

  // Modify video parameters
  if ($domain == 'youtube.com') {
    $html = str_replace( '?feature=oembed', '?feature=oembed'.'&amp;'.$parameters, $html );
  }
  if ($domain == 'vimeo.com') {
    $html = str_replace( '" width', '?'.$parameters.'" width', $html );
  }

  return $html;
}

// UTILITY FUNCTIONS

// get ID of page by slug
function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if($page) {
		return $page->ID;
	} else {
		return null;
	}
}
// is_single for custom post type
function is_single_type($type, $post) {
  if (get_post_type($post->ID) === $type) {
    return true;
  } else {
    return false;
  }
}

?>

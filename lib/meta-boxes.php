<?php

/* Get post objects for select field options */ 
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */
	$front_page_id = get_option('page_on_front');

	$front_page = new_cmb2_box( array(
		'id'            => $prefix . 'front_page',
		'title'         => __( 'Front page options', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
		'show_on'      => array( 'id' => array( $front_page_id ) ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$front_page->add_field( array(
		'name' => __( 'Image background', 'cmb2' ),
		'desc' => __( 'Upload an image or enter a URL.', 'cmb2' ),
		'id'   => $prefix . 'image_bg',
		'type' => 'file',
	) );

	$front_page->add_field( array(
		'name' => __( 'Video background', 'cmb2' ),
		'desc' => __( 'Enter a youtube or vimeo URL.', 'cmb2' ),
		'id'   => $prefix . 'video_bg',
		'type' => 'oembed',
	) );

	$front_page->add_field( array(
		'name' => __( 'Image overlay', 'cmb2' ),
		'desc' => __( 'Upload an image or enter a URL.', 'cmb2' ),
		'id'   => $prefix . 'image_overlay',
		'type' => 'file',
	) );

}
?>

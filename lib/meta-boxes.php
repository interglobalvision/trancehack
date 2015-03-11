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

  // POST METABOXES

  $post_metaboxes = new_cmb2_box( array(
      'id'            => $prefix . 'post_metabox',
      'title'         => __( 'Post Settings', 'cmb2' ),
      'object_types'  => array( 'post', ), // Post type
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true, // Show field names on the left
    )
  );

  $post_metaboxes->add_field( array(
      'name'       => __( 'Soundcloud', 'cmb2' ),
      'desc'       => __( 'soundcloud URL', 'cmb2' ),
      'id'         => $prefix . 'soundcloud',
      'type'       => 'text',
    )
  );

  $post_metaboxes->add_field( array(
      'name'       => __( 'Vimeo', 'cmb2' ),
      'desc'       => __( 'vimeo ID [only the numbers in the URL]', 'cmb2' ),
      'id'         => $prefix . 'vimeo',
      'type'       => 'text',
    )
  );

  // GIF METABOXES

  $gif_metaboxes = new_cmb2_box( array(
      'id'            => $prefix . 'gif_metabox',
      'title'         => __( 'Gif', 'cmb2' ),
      'object_types'  => array( 'gif', ), // Post type
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true, // Show field names on the left
    )
  );

  $gif_metaboxes->add_field( array(
      'name'       => __( 'THE GIF', 'cmb2' ),
      'desc'       => __( ' ', 'cmb2' ),
      'id'         => $prefix . 'gif',
      'type'       => 'file',
    )
  );

  // FRONT PAGE METABOXES

  $front_page_id = get_option('page_on_front');

  $front_page = new_cmb2_box( array(
      'id'            => $prefix . 'front_page',
      'title'         => __( 'Front page options', 'cmb2' ),
      'object_types'  => array( 'page', ), // Post type
      'show_on'      => array( 'id' => array( $front_page_id ) ),
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true, // Show field names on the left
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

  // ARTIST METABOXES
  require_once( 'Taxonomy_MetaData/Taxonomy_MetaData_CMB2.php' );
  $artist_meta = array(
    'id'         => $prefix . 'artist_meta',
    // 'key' and 'value' should be exactly as follows
    'show_on'    => array( 'key' => 'options-page', 'value' => array( 'unknown', ), ),
    'show_names' => true, // Show field names on the left
    'fields'     => array(
      array(
        'name' => __( 'Freestyle codez', 'taxonomy-metadata' ),
        'desc' => __( 'Enter fun codez', 'taxonomy-metadata' ),
        'id'   => $prefix . 'codez', // no prefix needed since the options are one option array.
        'type' => 'textarea_code',
      ),
      array(
        'name' => __( 'Dock icon', 'taxonomy-metadata' ),
        'id'   => $prefix . 'dock_icon',
        'type' => 'file',
        'options' => array(
          'url' => false,
        ),
      ),
    )
  );
  $cats = new Taxonomy_MetaData_CMB2( 'artist', $artist_meta, __( 'Artist Settings', 'taxonomy-metadata' ) );

}
?>

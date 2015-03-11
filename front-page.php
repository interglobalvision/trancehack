<?php
get_header();
?>

<!-- main content -->

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $image_bg = get_post_meta( $post->ID, '_igv_image_bg', true );
    $video_bg = esc_html(get_post_meta( $post->ID, '_igv_video_bg', true ));
    $image_overlay = get_post_meta( $post->ID, '_igv_image_overlay', true );
?>
<?php 
if ($image_bg) {
  echo '<div class="front-page-bg" style="background-image: url('.$image_bg.')"></div>';
}
if ($video_bg) {
  $video_embed_code = wp_oembed_get($video_bg, array( 'autoplay' => 1, 'modestbranding' => 1, 'showinfo' => 0, 'loop' => 1, 'title' => 0, 'portrait' => 0) ); 
  echo $video_embed_code;
}
if ($image_overlay) {
  echo '<div class="front-page-overlay" style="background-image: url('.$image_overlay.')"></div>';
}
?>
<?php
  }
} 
?>

<!-- end main-content -->

<?php
get_footer();
?>
<?php
// Menu icons for Custom Post Types
/*
function add_menu_icons_styles(){
?>

<style>
#adminmenu .menu-icon-project div.wp-menu-image:before {
    content: '\f498';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );
*/


//Register Custom Post Types
add_action( 'init', 'register_cpt_gif' );

function register_cpt_gif() {

    $labels = array(
        'name' => _x( 'Gifs', 'gif' ),
        'singular_name' => _x( 'Gif', 'gif' ),
        'add_new' => _x( 'Add New', 'gif' ),
        'add_new_item' => _x( 'Add New Gif', 'gif' ),
        'edit_item' => _x( 'Edit Gif', 'gif' ),
        'new_item' => _x( 'New Gif', 'gif' ),
        'view_item' => _x( 'View Gif', 'gif' ),
        'search_items' => _x( 'Search Gifs', 'gif' ),
        'not_found' => _x( 'No gifs found', 'gif' ),
        'not_found_in_trash' => _x( 'No gifs found in Trash', 'gif' ),
        'parent_item_colon' => _x( 'Parent Gif:', 'gif' ),
        'menu_name' => _x( 'Gifs', 'gif' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'thumbnail' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'gif', $args );
}

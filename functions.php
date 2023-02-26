<?php
//* Code goes here

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


// Our custom post type function
function create_posttype() {

    register_post_type( 'books',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Books' ),
                'singular_name' => __( 'Book' ),
                'menu_name'           => __( 'Books' ),
                'parent_item_colon'   => __( 'Parent Book' ),
                'all_items'           => __( 'All Books' ),
                'view_item'           => __( 'View Book' ),
                'add_new_item'        => __( 'Add New Book' ),
                'add_new'             => __( 'Add New' ),
                'edit_item'           => __( 'Edit Book' ),
                'update_item'         => __( 'Update Book' ),
                'search_items'        => __( 'Search Book' ),
                'not_found'           => __( 'Not Found' ),
                'not_found_in_trash'  => __( 'Not found in Trash' ),
            ),
            'rewrite' => array('slug' => 'books'),
            'label'               => __( 'books' ),
            'description'         => __( 'Books' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'show_in_rest'        => true,
            'taxonomies'          => array( 'category' ),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

<?php

    // ham tao menu
    add_theme_support('menus');
    // dang ky vi tri menu
    function theme_register_nav_menus()
    {
        register_nav_menus(
            array(
                'top-menu' => __('top menu', 'theme'),
                'main-menu' => __('main menu', 'theme')
            ));
    }
    add_action('init', 'theme_register_nav_menus');
    // ham dang ky custom post type
    add_action( 'init', 'create_post_type' );
    function create_post_type() {
        register_post_type( 'tour-dl',
            array(
                'labels' => array(
                    'name' => __( 'Tour' ),
                    'singular_name' => __( 'tour-dl' )
                ),
            'public' => true,
            'has_archive' => true,
            )
        );

        register_post_type( 'hotel',
            array(
                'labels' => array(
                    'name' => __( 'hotel' ),
                    'singular_name' => __( 'hotel' )
                ),
            'public' => true,
            'has_archive' => true,
            )
        );
    }
    
    // ham lay tieu de trang
    function get_page_title_by_slug() {
        $current_page_slug = basename(get_permalink());
        if (!empty($current_page_slug)) {
            return str_replace('-', ' ', $current_page_slug);
        } else {
            return '';
        }
    }
    // Hiển thị trường thêm hình ảnh trong form tạo bài viết
    function add_featured_image_to_post() {
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'post-thumbnails' );
        }
        add_meta_box(
            'postimagediv',
            __( 'Featured Image' ),
            'post_thumbnail_meta_box',
            'post',
            'side',
            'low'
        );
    }
    add_action( 'admin_init', 'add_featured_image_to_post' );
    // ham dang ky sidebar keo tha 
    function my_custom_sidebar() {
        register_sidebar(array(
            'name' => 'Kéo thả Sidebar',
            'id' => 'custom-sidebar',
            'description' => 'Vùng sidebar có thể kéo thả',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));
    }
    add_action('widgets_init', 'my_custom_sidebar');
    add_filter('wp_use_widgets_block_editor', '__return_false');
    
    // ham bat chuc nang binh luan cho cac truong custom post type
    function enable_comments_for_custom_post_types() {
        $post_types = array('tour-dl', 'hotel'); // Thay thế 'custom_post_type_1', 'custom_post_type_2' bằng các tên custom post type của bạn
    
        foreach ($post_types as $post_type) {
            add_post_type_support($post_type, 'comments');
        }
    }
    add_action('init', 'enable_comments_for_custom_post_types');
    

?>
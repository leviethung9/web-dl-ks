<?php
/**
 * Plugin Name: Custom Author Permissions
 * Description: Plugin to customize author permissions for default posts and custom post types.
 * Version: 1.0
 * Author: Hung Poly
 */

// Add capabilities to the author role
function custom_author_permissions() {
    $author_role = get_role('author');
    
    // Add capabilities for default posts
    $author_role->add_cap('edit_posts');
    $author_role->add_cap('edit_published_posts');
    $author_role->add_cap('delete_posts');
    $author_role->add_cap('delete_published_posts');
    
    // Add capabilities for custom post types
    $custom_post_types = array('tour-dl', 'hotel');
    
    foreach ($custom_post_types as $post_type) {
        $author_role->add_cap("edit_{$post_type}");
        $author_role->add_cap("edit_others_{$post_type}");
        $author_role->add_cap("publish_{$post_type}");
        $author_role->add_cap("delete_{$post_type}");
        $author_role->add_cap("delete_others_{$post_type}");
        $author_role->add_cap("read_private_{$post_type}");
    }
}
add_action('init', 'custom_author_permissions');
?>

<?php

include 'modules/select-search-list.php';
include 'modules/images-upload.php';



function connect_styles_scripts() { 
  wp_enqueue_style('my-custom-styles', get_template_directory_uri() . '/css/custom.css?v='.time());
  wp_enqueue_style('my-custom-styles-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
  wp_enqueue_script('my-custom-script-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
  wp_enqueue_script('my-custom-script-swiper-initialize', get_template_directory_uri() . '/js/slider.js', array(), null, true);



}
add_action('wp_enqueue_scripts', 'connect_styles_scripts');

function my_admin_scripts() {
  // Enqueue your script here
  wp_enqueue_script('my-custom-script', "https://cdn.jsdelivr.net/npm/vue/dist/vue.js");
  wp_enqueue_script('my-custom-script-2', "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js");
  wp_enqueue_script('my-custom-script-3', "https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js");
  wp_enqueue_script('my-custom-script-36', "https://unpkg.com/vue-multiselect@2.1.6");

  wp_enqueue_style('my-custom-styles-1', 'https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css');

  wp_enqueue_script('my-custom-script-4', get_template_directory_uri() . '/js/real-estate-select.js', array(), null, true);
  wp_enqueue_script('my-custom-script-5', get_template_directory_uri() . '/js/image-upload.js', array(), null, true);

}
add_action('admin_enqueue_scripts', 'my_admin_scripts');


$post_id = get_the_ID(); // Get the ID of the current post, or specify the post ID if you want to get the post type of a specific post

//if(isset($_FILES['photos'])) {
//
//    function  insert_attachment($file_handler,$post_id, $path) {
//
//
//        require_once($path . "wp-admin" . '/includes/image.php');
//        require_once($path . "wp-admin" . '/includes/file.php');
//        require_once($path . "wp-admin" . '/includes/media.php');
//        $attach_id = media_handle_upload( $file_handler, $post_id );
//
//
//        echo $attach_id;
//        update_post_meta($post_id,'images',$attach_id);
//
//        die();
//
//        return $attach_id;
//    }
//
//    $files = $_FILES['photos'];
//    $path = ABSPATH;
//
//    $newupload = insert_attachment($files, $post_id, $path);
//
//}



/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}
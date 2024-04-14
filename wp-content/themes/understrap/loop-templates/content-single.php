<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_id = get_the_ID(); // Get the ID of the current post, or specify the post ID if you want to get the post type of a specific post
$post_type = get_post_type($post_id);
$meta_data = get_post_meta($post_id);
$info_tag = ['area' => 'Общая площадь','real_area' => 'Жилая площадь','floor' => 'Этаж'];

$image_ids = get_post_meta( $post_id, 'images', true );
$image_ids = explode(',', $image_ids);

$taxonomy = 'real-estate-type'; // Your taxonomy slug
$terms = get_the_terms($post_id, $taxonomy);

$showList = (isset($args['showList'])) ? $args['showList'] : '';

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php if($post_type == 'real-estate') include 'blocks/real-estate.php'; ?>
    <?php if($post_type == 'city' && !$showList) include 'blocks/city.php'; ?>
    <?php if($post_type == 'city' && $showList) include 'blocks/apartment-list.php'; ?>


	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

	

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->

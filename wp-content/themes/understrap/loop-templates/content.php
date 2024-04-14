<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_id = get_the_ID();
$taxonomy = 'real-estate-type'; // Your taxonomy slug

$terms = get_the_terms($post_id, $taxonomy);
$meta_data = get_post_meta($post_id);

$post_type = get_post_type($post_id);
$style = ' align-items: flex-end;';
if($post_type == 'city') {
	$style = ' align-items: center;';
}


?>


<article style="margin-top: 24px;" <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div style="display: flex; gap: 24px; <?= $style; ?>">
		<div class="image-block">
			<?php echo get_the_post_thumbnail( $post_id, 'medium' ); ?>

		</div>
		<div class="info-block">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php if($post_type == 'real-estate'): ?>
			<div class="tags">
				<?php 
				if ($terms && !is_wp_error($terms)) {
					foreach ($terms as $term) {
						echo "<span style='background-color: green;'>{$term->name}</span>";
					}
				} 
				
				foreach ($meta_data as $key => $values) {	
					if(in_array($key,['area','real-area','price','floor'])) {
						foreach ($values as $value) {
							$info_txt = (isset($info_tag[$key])) ? $info_tag[$key]." : ".$value : $value;
							echo "<span>{$info_txt}</span>";
						}
					}
					
				} ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

</article>

<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );


?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<?php
			// Do the left sidebar check and open div#primary.
			get_template_part( 'global-templates/left-sidebar-check',  null, array( 'className' => 'col-md-8' ) );
			?>

			<main class="site-main" id="main">

				<h2>Список недвижимостей</h2>

				<?php

				$apartments = new WP_Query( array(
					'post_type' => 'real-estate',
					'posts_per_page' => 5
				));

				if ( $apartments->have_posts() ) {
					// Start the Loop.
					while ( $apartments->have_posts() ) {
						$apartments->the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', get_post_format() );
					}
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				?>

			</main>

			<?php
			// Display the pagination component.
			understrap_pagination();

			// Do the right sidebar check and close div#primary.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

            <?php get_template_part( 'global-templates/left-sidebar-check', null, array( 'className' => 'col-md-4' ) ); ?>
				<h3>Список городов</h3>

				<?php

				$cities = new WP_Query( array(
					'post_type' => 'city',
					'posts_per_page' => 5
				));

				if ( $cities->have_posts() ) {
					// Start the Loop.
					while ( $cities->have_posts() ) {
						$cities->the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', get_post_format() );
					}
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				?>

			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>


		</div><!-- .row -->

	</div><!-- #content -->

	<div class="form-block">
		<h3>Форма для отправки данных</h3>
		<?php echo do_shortcode( '[cf7form cf7key="real-estate-form"]' ); ?>
	</div>

	

</div><!-- #index-wrapper -->

<?php
get_footer();

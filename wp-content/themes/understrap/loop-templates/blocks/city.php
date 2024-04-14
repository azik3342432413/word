<header class="entry-header">

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

</header>

<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
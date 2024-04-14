<?php
$apartments = new WP_Query( array(
        'post_type' => 'real-estate',
        'post__in' => get_post_meta( $post_id, 'real_estate', true ),
        'posts_per_page' => 5

    ));
    ?>
    <h3>Apartments list in this city</h3>
    <div style="display: flex; gap: 24px; flex-direction: column;">
    <?php
    if ( $apartments-> have_posts() ) { while ( $apartments->have_posts() ) {
        $apartments->the_post();
        ?>

        <div style="display: flex; gap: 24px; align-items: flex-end;">
            <div class="image-block">
                <?php
                $apartment_id = get_the_ID();
                $terms = get_the_terms($apartment_id, $taxonomy);
                $meta_data = get_post_meta($apartment_id);

                echo get_the_post_thumbnail( $apartment_id, 'medium' ); 

                ?>

            </div>
            <div class="info-block">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <div class="tags">
                    <?php 
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo "<span style='background-color: green;'>{$term->name}</span>";
                        }
                    } else {
                        echo 'No terms found for taxonomy ' . $taxonomy . ' for this post.';
                    }
                    foreach ($meta_data as $key => $values) {	
                        if(in_array($key,['area','real_area','price','floor'])) {
                            foreach ($values as $value) {
                                $info_txt = (isset($info_tag[$key])) ? $info_tag[$key]." : ".$value : $value;
                                echo "<span>{$info_txt}</span>";
                            }
                        }
                        
                    } ?>
                </div>
            </div>
        </div>
        
    

        <?php
    } }

    ?>
    </div>

<header class="entry-header">

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <div class="info-block">
        <div class="tags">
            <?php 
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    echo "<span style='background-color: green;'>{$term->name}</span>";
                }
            } 
            foreach ($meta_data as $key => $values) {	
                if(in_array($key,['area','real_area','price','floor','address'])) {
                    foreach ($values as $value) {
                        $info_txt = (isset($info_tag[$key])) ? $info_tag[$key]." : ".$value : $value;
                        echo "<span>{$info_txt}</span>";
                    }
                }
                
            } ?>
        </div>
    </div>

</header>


<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <?php foreach( $image_ids as $i => &$id ): $url = wp_get_attachment_image_url( $id, [1000,1000] ); ?>
        <?php if($url): ?>
        <div class="swiper-slide">
            <img src="<?= $url; ?>" alt="">
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>
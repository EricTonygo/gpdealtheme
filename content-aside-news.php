<?php
$latest_news = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, "post_status" => 'publish', 'category_name' => __('news', 'gpdealdomain'), 'orderby' => 'post_date', 'order' => 'DESC'));
if ($latest_news->have_posts()) :
    ?>
    <div class="ui segment">
        <div class="owl-carousel" id="single-second-slider">
            <?php
            while ($latest_news->have_posts()): $latest_news->the_post()
                ?>
                <div class="item">
                    <p>
                        <?php if (has_post_thumbnail()): ?>
                            <img class="ui image" src="<?php the_post_thumbnail_url('full'); ?>">
                        <?php endif ?>
                    </p>
                    <div align="center">
                        <a class="ui header" href="<?php echo wp_make_link_relative(get_permalink()); ?>"><?php the_title() ?></a>
                        <p><?php the_content() ?></p>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
 endif ?>
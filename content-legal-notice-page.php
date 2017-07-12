<?php get_template_part('top-menu', get_post_format()); ?>
<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <div class="ui tiny borderless second-nav menu">
            <div class="ui container center aligned">
                <div class="center menu">
                    <div class="item">
                        <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                        <i class="small right arrow icon divider"></i>
                        <div class="active section"><?php the_title(); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui vertical masthead  segment container">
            <!--div class="ui text container">
            </div-->
            <div class="ui stackable grid">

                <div class="twelve wide column">
                    <div id="content_search_carrier_form" class="ui fluid card">
                        <div class="content content_page">
                            <div class="ui fluid card" style="box-shadow: none">
                                <div class="content">
                                    <p>
                                        <?php echo the_content(); ?>
                                    </p>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide column">
                    <div class="four wide column">
                        <?php
                        $latest_news = new WP_Query(array('post_type' => 'post', 'post_per_page' => 5, "post_status" => 'publish', 'category_name' => __('news', 'gpdealdomain'), 'orderby' => 'post_date', 'order' => 'DESC'));
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
                                                    <img class="ui rounded image" src="<?php the_post_thumbnail_url('full'); ?>">
                                                <?php endif ?>
                                            </p>
                                            <div align="center">
                                                <div class="ui header"><?php the_title() ?></div>
                                                <p><?php the_content() ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    endwhile; endif; 
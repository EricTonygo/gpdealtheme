<?php get_template_part('top-menu', get_post_format()); ?>

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
                    <?php
                    $terms_use = new WP_Query(array('post_type' => 'term-use', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'ASC'));
                    if ($terms_use->have_posts()) :
                        ?>
                        <div class="ui styled fluid accordion">
                            <?php while ($terms_use->have_posts()): $terms_use->the_post();
                                ?>
                                <div class="title"><i class="dropdown icon"></i> <?php the_title(); ?> </div>
                                <div class="content">
                                    <p class="transition hidden"><?php the_content(); ?></p>
                                </div>
                            <?php endwhile; ?>                                                             
                        </div>
                        <?php
                    endif;
                    wp_reset_postdata();
                    ?>   
                </div>
            </div>
        </div>
        <div class="four wide column">
            <?php include(locate_template("content-aside-news.php")); ?>
        </div>
    </div>
</div>
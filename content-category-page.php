<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(esc_url(get_permalink(get_page_by_path(__('blog', 'gpdealdomain'))))); ?>" class="section"><?php echo __("Blog", "gpdealdomain"); ?></a>
                <i class="small right chevron icon divider"></i>
                <div class="active section"><?php echo __("Categories", "gpdealdomain"); ?></div>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php echo get_category(get_query_var('cat'))->name; ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <div class="ui stackable grid">
        <div class="eleven wide column">
            <div id="content_search_carrier_form" class="ui fluid card">
                <div class="content content_page">
                    <div class="ui fluid card" style="box-shadow: none">
                        <div class="content">
                            <?php
                            if ($category_posts->have_posts()) :
                                ?>
                                <div class="ui divided items">
                                    <?php
                                    while ($category_posts->have_posts()): $category_posts->the_post()
                                        ?>
                                        <div class="item">
                                            <?php if (has_post_thumbnail()): ?>
                                                <a class="image" href="<?php echo wp_make_link_relative(get_permalink()); ?>">
                                                    <img src="<?php the_post_thumbnail_url('full'); ?>">
                                                </a>
                                            <?php endif ?>
                                            <div class="content">
                                                <a class="header post_title" href="<?php echo wp_make_link_relative(get_permalink()); ?>"><?php the_title() ?></a>
                                                <div class="meta">
                                                    <?php
                                                    $comments_count = wp_count_comments(get_the_ID())->approved;
                                                    ?>
                                                    <!--<span class="cinema"><?php echo get_the_author() ?> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> <?php _e("ago", "gpdealdomain"); ?> | <?php echo $comments_count; ?> <?php if ($comments_count > 1): ?>comments<?php else: ?><?php endif ?>comment</span>-->
                                                </div>
                                                <div class="description post_title">
                                                    <p><?php the_excerpt() ?></p>
                                                </div>
                                                <div class="extra">
                                                    <span><?php _e("Posted on", "gpdealdomain"); ?>: </span>
                                                    <?php
                                                    $post_categories = wp_get_post_categories(get_the_ID());
                                                    ?>
                                                    <?php foreach ($post_categories as $c): $category = get_category($c); ?>
                                                        <a href="<?php echo wp_make_link_relative(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a>
                                                    <?php endforeach; ?>
                                                    <div class="right floated">
                                                        <a href="<?php echo wp_make_link_relative(get_permalink()); ?>">En savoir plus</a>
                                                        <i class="right chevron icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            <?php else: ?>
                                <div class="ui warning message">
                                    <i class="close icon"></i>
                                    <?php _e("We do not have news published at this time", "gpdealdomain"); ?>.                      
                                </div>
                            <?php endif ?>
                        </div>                                
                    </div>
                </div>
            </div>
        </div>
        <div class="five wide column">
            <?php include(locate_template("content-aside-blog.php")); ?>
        </div>
    </div>
</div>
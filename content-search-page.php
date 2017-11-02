<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php _e("Search information results", "gpdealdomain"); ?></div>
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
                            if ($search_results->have_posts()) :
                                ?>
                                <div class="ui divided items">
                                    <?php
                                    while ($search_results->have_posts()): $search_results->the_post()
                                        ?>
                                        <div class="item">
                                            <div class="content">
                                                <a class="header post_title" href="<?php echo wp_make_link_relative(get_permalink()); ?>"><?php the_title() ?></a>                                               
                                                <div class="description post_title">
                                                    <p><?php the_excerpt() ?></p>
                                                </div>  
                                                <div class="extra">
                                                
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
                                    <?php _e("No results match your keywords", "gpdealdomain"); ?>.                      
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
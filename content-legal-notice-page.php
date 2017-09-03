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
                                    <?php //var_dump(ip_visitor_data()); ?>
                                    <p>
                                        <?php echo the_content(); ?>
                                    </p>

                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide column">
                    <?php include(locate_template("content-aside-news.php")); ?>
                </div>
            </div>
        </div>

        <?php
    endwhile; endif; 
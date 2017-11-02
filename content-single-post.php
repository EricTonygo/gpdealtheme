<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="small right chevron icon divider"></i>
                <a href="<?php echo wp_make_link_relative(esc_url(get_permalink(get_page_by_path(__('blog', 'gpdealdomain'))))); ?>" class="section"><?php echo __("Blog", "gpdealdomain"); ?></a>
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <div class="ui vertical masthead  segment container">
            <div class="ui stackable grid">
                <div class="eleven wide column">
                    <div id="content_search_carrier_form" class="ui fluid card">
                        <div class="content content_page">
                            <div class="ui fluid card single_post" style="box-shadow: none">
                                <div class="content">
                                    <div class="header post_title" ><?php the_title() ?></div>
                                    <div class="meta" style="text-align: right">
                                        <span>
                                            <strong><?php _e("Share on", "gpdealdomain"); ?>:</strong>
                                        </span>
                                        <span style="margin-left: 1em">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(the_permalink())) ?>&title=<?php print(urlencode(the_title())) ?>" target="_blank" class="ui mini circular facebook icon button" onclick="javascript:window.open(this.href, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"><i class="facebook icon"></i>  </a>
                                            <a href="https://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())) ?>+<?php print(urlencode(the_permalink())) ?>" target="_blank" class="ui mini circular twitter icon button" onclick="javascript:window.open(this.href, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"><i class="twitter icon"></i></a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php print(urlencode(the_permalink())) ?>&title=<?php print(urlencode(the_title())) ?>&source=<?php echo get_home_url() ?>" target="_blank" class="ui mini circular linkedin icon button" onclick="javascript:window.open(this.href, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"> <i class="linkedin icon"></i></a>
                                            <a href="https://plus.google.com/share?url=<?php print(urlencode(the_permalink())) ?>" target="_blank" class="ui mini circular google plus icon button" onclick="window.open(this.href, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"><i class="google plus icon"></i></a>
                                            <!--<a href="whatsapp://send?text=<?php the_excerpt() ?> <?php print(urlencode(the_permalink())) ?>" data-action="share/whatsapp/share" class="ui circular green whatsapp icon button"><i class="whatsapp icon"></i></a>-->
                                        </span>
                                        <?php
                                            $previous_post = get_previous_post();
                                            $next_post = get_next_post();
                                        ?>
                                        <span style="margin-left: 2em">
                                            <?php                                            
                                            if (!empty($previous_post)):
                                                ?>
                                                <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" style="text-decoration: none;"><i class="long arrow left icon"></i> <?php _e("Previous", "gpdealdomain"); ?></a>
                                            <?php endif; ?>
                                            <?php if (!empty($previous_post) && !empty($next_post)): ?>
                                                |
                                            <?php endif ?>
                                            <?php
                                            if (!empty($next_post)):
                                                ?>
                                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" style="text-decoration: none;"><?php _e("Next", "gpdealdomain"); ?> <i class="long arrow right icon"></i></a>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="image">
                                        <img src="<?php the_post_thumbnail_url('full'); ?>">
                                    </div>
                                <?php endif ?>
                                <div class="content">
                                    <p><?php the_content(); ?></p>
                                </div>
                                <div class="content">
                                    <span><?php _e("Posted on", "gpdealdomain"); ?> : </span>
                                    <?php
                                    $post_categories = wp_get_post_categories(get_the_ID());
                                    ?>
                                    <?php foreach ($post_categories as $c): $category = get_category($c); ?>
                                        <a href="<?php echo wp_make_link_relative(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a>
                                    <?php endforeach; ?>
                                    <span class="right floated">
                                        <?php
                                        if (!empty($previous_post)):
                                            ?>
                                            <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" style="text-decoration: none;"><i class="long arrow left icon"></i> <?php _e("Previous", "gpdealdomain"); ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($previous_post) && !empty($next_post)): ?>
                                            |
                                        <?php endif ?>
                                        <?php
                                        if (!empty($next_post)):
                                            ?>
                                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" style="text-decoration: none;"><?php _e("Next", "gpdealdomain"); ?> <i class="long arrow right icon"></i></a>
                                        <?php endif; ?>
                                    </span>
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
        <?php
    endwhile; endif; 
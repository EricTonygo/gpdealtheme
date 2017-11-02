<div class="ui fluid card aside_blog_card">
    <div class="content">
        <form  class="ui fluid form" action="<?php echo wp_make_link_relative(get_site_url() . '/'); ?>" method="GET">
                <div class="field">               
                    <div class="ui icon input">                    
                        <input type="text" name="s" value="<?php
                    if (isset($_GET['s'])) {
                        echo stripslashes($_GET['s']);
                    }
                    ?>" placeholder="<?php _e("Search information", "gpdealdomain") ?>...">                   
                        <i class="search icon"></i>
                    </div>               
                </div>
            </form>
    </div>
</div>
<?php
$categories = get_categories(array('hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC'));
if (!empty($categories)) :
    ?>
    <div class="ui fluid card aside_blog_card">
        <div class="content">
            <div class="header post_title"><?php _e("Rubriques", "gpdealdomain"); ?></div>
        </div>
        <div class="content" style="border-bottom: none">
            <div class="ui relaxed divided list">
                <?php foreach ($categories as $c): $category = get_category($c); ?>
                    <div class="item">
                        <i class="large angle right middle aligned icon"></i>
                        <div class="content" style="border-bottom: none;">
                            <a class="header" href="<?php echo wp_make_link_relative(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
<?php endif
?>

<?php
$latest_news = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, "post_status" => 'publish', 'category_name' => __('news', 'gpdealdomain'), 'orderby' => 'post_date', 'order' => 'DESC'));
if ($latest_news->have_posts()) :
    ?>
    <div class="ui fluid card aside_blog_card">
        <div class="content">
            <div class="header post_title"><?php _e("Latest News", "gpdealdomain"); ?></div>
        </div>
        <div class="content" style="border-bottom: none">
            <div class="ui relaxed divided list">
                <?php
                while ($latest_news->have_posts()): $latest_news->the_post()
                    ?>
                    <div class="item">
                        <i class="large angle right middle aligned icon"></i>
                        <div class="content" style="border-bottom: none;">
                            <a class="header" href="<?php echo wp_make_link_relative(get_permalink()); ?>"><?php the_title() ?></a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
    <?php


 endif ?>

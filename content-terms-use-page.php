<?php get_template_part('top-menu', get_post_format()); ?>
<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <div class="ui large borderless second-nav menu">
            <div class="ui container center aligned">
                <div class="center menu">
                    <div class="item">
                        <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                        <i class="right arrow icon divider"></i>
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
                    <?php if (!is_user_logged_in()): ?>
<!--                        <div class="ui fluid card">
                            <div class="content center aligned">
                                <p>Particuliers / Professionnels</p>
                                <p>Pas encore membre ?</p>
                                <a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))) ?>" class="ui green fluid button" type="submit">Inscrivez-vous</a>
                            </div>
                        </div>-->
                    <?php endif ?>
                    <div class="ui segment">
                        <div class="owl-carousel" id="single-second-slider">
                            <div class="item">
                                <p><img class="ui rounded image" src="<?php echo get_template_directory_uri() ?>/assets/images/400x400.png"></p>
                                <div align="center">
                                    <div class="ui header">Titre de l'image 1</div>
                                    <p>Description de l'image 1</p>
                                </div>
                            </div>
                            <div class="item">
                                <p><img class="ui rounded image" src="<?php echo get_template_directory_uri() ?>/assets/images/400x400.png"></p>
                                <div align="center">
                                    <div class="ui header">Titre de l'image 2</div>
                                    <p>Description de l'image 2</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    endwhile; endif; 
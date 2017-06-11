<?php get_template_part('top-menu', get_post_format()); ?>
<?php if (have_posts()): while (have_posts()): the_post(); ?>
        <div class="ui large borderless second-nav menu">
            <div class="ui container center aligned">
                <div class="center menu">
                    <div class="item">
                        <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section"><?php the_title(); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui vertical masthead segment container">
            <!--div class="ui text container">
            </div-->
            <div class="ui stackable grid">

                <div class="twelve wide column">
                    <div id="content_search_carrier_form" class="ui fluid card">
                        <div class="content content_page">
                            <form id='contact_form' action="<?php echo wp_make_link_relative(get_the_permalink()) ?>" class="ui form" autocomplete="off">
                                <?php if (!is_user_logged_in()): ?>
                                    <div class="inline fields">
                                        <div class="field myrole">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="role" value="particular" >
                                                <label><?php _e("Particular", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                        <div class="field myrole">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="role" value="professional">
                                                <label for="redacteur"><?php _e("Professional", "gpdealdomain"); ?></label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="inline fields">
                                                <label><?php _e("Already a member", "gpdealdomain"); ?> ? : </label>
                                                <div class="field">
                                                    <div class="ui radio checkbox">
                                                        <input type="radio" name="member" value="yes">
                                                        <label><?php _e("Yes", "gpdealdomain"); ?></label>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <div class="ui radio checkbox">
                                                        <input type="radio" name="member" value="no">
                                                        <label><?php _e("No", "gpdealdomain"); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='block_visitor'>
                                        <div class="fields">
                                            <div class="four wide field">
                                                <label><?php _e("Civility", "gpdealdomain"); ?> </label>
                                            </div>
                                            <div class="twelve wide field">
                                                <div class="inline fields">
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            <input type="radio" name="civility" value="Mr.">
                                                            <label><?php _e("Mr.", "gpdealdomain"); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            <input type="radio" name="civility" value="Mrs">
                                                            <label><?php _e("Mrs", "gpdealdomain"); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            <input type="radio" name="civility" value="Ms">
                                                            <label><?php _e("Ms", "gpdealdomain"); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="two fields">
                                            <div class="field">
                                                <label><?php _e("First name", "gpdealdomain"); ?></label>
                                                <input type="text" placeholder="<?php _e("First name", "gpdealdomain"); ?>" name="firstname">
                                            </div>

                                            <div class="field">
                                                <label><?php _e("Last name", "gpdealdomain"); ?></label>
                                                <input type="text" placeholder="<?php _e("Last name", "gpdealdomain"); ?>" name="lastname">
                                            </div>
                                        </div>

                                        <div class="two fields">
                                            <div class="field">
                                                <label><?php _e("Office", "gpdealdomain"); ?></label>
                                                <input type="text" placeholder="<?php _e("Office", "gpdealdomain"); ?>" name="function">
                                            </div>

                                            <div class="eight wide field">
                                                <label><?php _e("Company Identification Number", "gpdealdomain"); ?></label>
                                                <input type="text" placeholder="<?php _e("Company Identification Number", "gpdealdomain"); ?>" name="company_identity_number">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label><?php _e("Phone Number", "gpdealdomain"); ?></label>
                                            <div class="fields">
                                                <div class="five wide field">
                                                    <div class="ui fluid search selection dropdown">
                                                        <input type="hidden" name="country_code">
                                                        <i class="dropdown icon"></i>
                                                        <div class="default text"><?php _e("Select Country Code", "gpdealdomain"); ?></div>
                                                        <?php include(locate_template('content-select-country.php')); ?>
                                                    </div>
                                                </div>
                                                <div class="eleven wide field">
                                                    <input type="tel" name="phone_number" placeholder="<?php _e("Phone Number", "gpdealdomain"); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                    <div class="field">
                                        <label><?php _e("E-mail Address", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                        <input type="email" placeholder="<?php _e("E-mail Address", "gpdealdomain"); ?>" name="email">
                                    </div>
                                <?php endif ?>
                                <div class="field">
                                    <label><?php _e("Social Reasons", "gpdealdomain"); ?></label>
                                    <input type="text" placeholder="<?php _e("Social Reasons", "gpdealdomain"); ?>" name="social_reasons">
                                </div>
                                <div class="field">
                                    <label><?php _e("Subject", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    <input type="text" placeholder="<?php _e("Subject", "gpdealdomain"); ?>" name="subject">
                                </div>

                                <div class="field">
                                    <label><?php _e("Message", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    <textarea placeholder="<?php _e("Enter your message here", "gpdealdomain"); ?>" name="message"></textarea>
                                </div>

                                <button id="submit_contact_form" class="ui right floated green button" type="submit"><i class="send icon"></i><?php _e("Send", "gpdealdomain"); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
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
    <?php
    endwhile;
endif;
?>
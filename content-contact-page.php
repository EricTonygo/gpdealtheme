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
        <div class="ui vertical masthead segment container">
            <!--div class="ui text container">
            </div-->
            <div class="ui stackable grid">

                <div class="twelve wide column">
                    <div id="content_search_carrier_form" class="ui fluid card">
                        <div class="content content_page">
                            <form id='contact_form' action="<?php echo wp_make_link_relative(get_the_permalink()) ?>" class="ui form">
                                <?php if (!is_user_logged_in()): ?>
                                    <div class=" fields">
                                        <div class="three wide field">
                                            <label><?php _e("Already a member", "gpdealdomain"); ?> ? </label>
                                        </div>
                                        <div class="twelve wide field">
                                            <div class="inline fields">
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
                                    <div class="field block_visitor">
                                        <label><?php _e("Name or Campany name", "gpdealdomain"); ?></label>
                                        <input type="text" placeholder="<?php _e("Your name or campany name", "gpdealdomain"); ?>" name="name_companyname">
                                    </div>
                                    <div class="field block_visitor">
                                        <label><?php _e("Phone", "gpdealdomain"); ?></label>
                                        <div class="fields">
                                            <div class="six wide field">
                                                <div class="ui fluid search selection dropdown">
                                                    <input type="hidden" name="phone_country_code" >
                                                    <i class="dropdown icon"></i>
                                                    <div class="default text"><?php _e("Select Country", "gpdealdomain"); ?></div>
                                                    <?php include(locate_template('content-select-country.php')); ?>
                                                </div>
                                            </div>
                                            <div class="ten wide field">
                                                <input type="tel" name="phone_number" placeholder="<?php _e("Phone number", "gpdealdomain"); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label><?php _e("E-mail Address", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                        <input type="email" placeholder="<?php _e("E-mail Address", "gpdealdomain"); ?>" name="email">
                                    </div>
                                <?php endif ?>
                                <div class="field">
                                    <label><?php _e("Subject", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    <input type="text" placeholder="<?php _e("Subject", "gpdealdomain"); ?>" name="subject">
                                </div>

                                <div class="field">
                                    <label><?php _e("Message", "gpdealdomain"); ?> <span style="color:red;">*</span></label>
                                    <textarea placeholder="<?php _e("Enter your message here", "gpdealdomain"); ?>" name="message"></textarea>
                                </div>

                                <button id="submit_contact_form" class="ui right floated green button" type="submit"><i class="send icon"></i><?php _e("Send your message", "gpdealdomain"); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="four wide column">
                    <?php include(locate_template("content-aside-news.php")); ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;
endif;
?>
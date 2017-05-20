<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <!--div class="ui text container">
    </div-->
    <div class="ui signup_contenair basic segment container">
        <div class="ui attached message">
            <div class="header"><?php echo __("Forgot your password", 'gpdealdomain') ?> </div>
            <p class="promo_text_form"><?php echo __("Fill in the information below to obtain your password", 'gpdealdomain') ?>.</p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <form id='forgot_password_form'  method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-your-password', 'gpdealdomain')))); ?>" class="ui form" autocomplete="off">
                    <div class="fields">
                        <div class="four wide field">
                            <label><?php echo __("E-mail address", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <input type="email" name="email" placeholder="<?php echo __("E-mail address", 'gpdealdomain') ?>">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label><?php echo __("Your test question", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <select name="test_question" class="ui search fluid dropdown">
                                <option value=""><?php _e("Select your test question", 'gpdealdomain'); ?> </option>
                                <?php
                                $question1s = new WP_Query(array('post_type' => 'question', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'ASC'));
                                if ($question1s->have_posts()) {
                                    while ($question1s->have_posts()): $question1s->the_post();
                                        ?>
                                        <option value="<?php the_ID() ?>"><?php the_title() ?></option>
                                        <?php
                                    endwhile;
                                }
                                wp_reset_postdata();
                                ?>
                            </select>
                        </div>                        
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label><?php _e("Answer to your test question", 'gpdealdomain'); ?> <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <input type="text" name="answer_test_question" placeholder="<?php _e("Answer to your test question", 'gpdealdomain'); ?>">
                        </div>                              
                    </div>

                    <div class="field">
                        <div id="server_error_message" class="ui negative message" style="display:none">
                            <i class="close icon"></i>
                            <div id="server_error_content" class="header"><?php _e("Internal server error", 'gpdealdomain'); ?></div>
                        </div>
                        <div id="error_name_message" class="ui error message" style="display: none">
                            <i class="close icon"></i>
                            <div id="error_name_header" class="header"></div>
                            <ul id="error_name_list" class="list">

                            </ul>
                        </div>
                    </div>
                    <button id="submit_forgot_password" class="ui right floated green button" ><i class="send icon"></i><?php _e("Send", 'gpdealdomain'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php get_template_part('top-menu', get_post_format()); ?>
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
    <div class="ui signup_contenair basic segment container">
        <div class="ui attached message">
            <div class="header"><?php echo __("Mot de passe oublié", 'gpdealdomain') ?> : </div>
            <p><?php echo __("Remplissez ci-dessous les informations nécessaires pour la demande de votre mot de passe.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <form id='forgot_password_form'  method="POST" action="<?php the_permalink(get_page_by_path(__('mot-de-passe-oublie', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off">
                    <div class="fields">
                        <div class="four wide field">
                            <label>Adresse email <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <input type="email" name="email" placeholder="Adresse email">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Question test <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <select name="test_question" class="ui fluid dropdown">
                                <option value="">Selectionner une question </option>
                                <?php
                                wp_reset_postdata();
                                query_posts(array('post_type' => 'question', 'post_per_page' => -1, "post_status" => 'publish'));
                                while (have_posts()): the_post()
                                    ?>
                                    <option value="<?php the_ID() ?>"><?php the_title() ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>                        
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Reponse à la question test <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <input type="text" name="answer_test_question" placeholder="Reponse à la question test">
                        </div>                              
                    </div>

                    <div class="field">
                        <div id="server_error_message" class="ui negative message" style="display:none">
                            <i class="close icon"></i>
                            <div id="server_error_content" class="header">Internal server error</div>
                        </div>
                        <div id="error_name_message" class="ui error message" style="display: none">
                            <i class="close icon"></i>
                            <div id="error_name_header" class="header"></div>
                            <ul id="error_name_list" class="list">

                            </ul>
                        </div>
                    </div>
                        <button id="submit_forgot_password" class="ui right floated green button" ><i class="send icon"></i>Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>


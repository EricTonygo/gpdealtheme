<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?></a>
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
            <div class="header"><?php echo __("Modifier le mot de passe", 'gpdealdomain') ?> </div>
            <p class="promo_text_form"><?php echo __("Remplissez les informations ci-dessous nécessaires pour modifier votre mot de passe.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <form id='reset_password_form'  method="POST" action="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('modifier-le-mot-de-passe', 'gpdealdomain'))); ?>" class="ui form" autocomplete="off">
                    <div class="fields">
                        <div class="four wide field">
                            <label>Mot de passe actuel <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <div class="ui input right icon">
                                <!--<i id="show_hide_old_password" class="unhide link icon"></i>-->
                                <input id='old_password' type="password" name="old_password" placeholder="Mot de passe">
                            </div>
                        </div>
                    </div>
                    
                    <div class="fields">
                        <div class="four wide field">
                            <label>Nouveau mot de passe <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <div class="ui input right icon">
                                <!--<i id="show_hide_new_password" class="unhide link icon"></i>-->
                                <input id='new_password' type="password" name="new_password" placeholder="Nouveau mot de passe">
                            </div>
                        </div>
                    </div>
                    
                    <div class="fields">
                        <div class="four wide field">
                            <label>Confirmer nouveau mot de passe <span style="color:red;">*</span></label>
                        </div>
                        <div class="twelve wide field">
                            <div class="ui input right icon">
                                <!--<i id="show_hide_confirm_new_password" class="unhide link icon"></i>-->
                                <input id='confirm_new_password' type="password" name="confirm_new_password" placeholder="Confirmer nouveau mot de passe">
                            </div>
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
                    <button id="submit_reset_password" class="ui right floated green button" style="min-width: 12px"><i class="edit icon"></i>Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>


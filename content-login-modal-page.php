<div id="login_modal" class="ui small modal">
    <i class="close icon"></i>
    <div class="header">
        <?php echo __("Connexion", "gpdealdomain"); ?>
    </div>
    <div class="content">            
        <form id="login_form3"  method="POST" class="ui form login_form" action="<?php echo get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))) ?>" style="margin-bottom: 1em" autocomplete="off">
            <div class="field">
                <label>Email ou pseudo <span style="color: red;">*</span></label>
                <div class="ui input left icon">
                    <i class="mail icon"></i>
                <input type="text" name="_username" placeholder="Email ou pseudo">
                </div>
            </div>
            <div class="field">
                <label>Mot de passe <span style="color: red;">*</span></label>
                <div class="ui input left icon">
                    <i class="lock icon"></i>
                    <input type="password" name="_password" placeholder="Mot de passe">
                </div>
            </div>
                <input type="hidden" name='no_redirect' value="true" >
            <div class="inline field">
                <div class="ui checkbox">
                    <input type="checkbox" name="_remember" value="true">
                    <label>Se souvenir de moi</label>
                </div>
            </div>
            <div class="field">
                <div id="server_error_message3" class="ui negative message" style="display:none">
                    <i class="close icon"></i>
                    <div id="server_error_content3" class="header">Internal server error</div>
                </div>
                <div id="error_name_message3" class="ui error message" style="display: none">
                    <i class="close icon"></i>
                    <ul id="error_name_list3" class="list">

                    </ul>
                </div>
            </div>
            <div class="field center aligned">
                <a href="<?php echo get_permalink(get_page_by_path(__('mot-de-passe-oublie', 'gpdealdomain'))); ?>" ><?php echo __("Mot de passe oublié", "gpdealdomain") ?> ?</a> <span><?php echo __("Vous n'avez un compte", "gpdealdomain") ?> ? </span><a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))); ?>" ><?php echo __("S'inscrire", "gpdealdomain") ?></a>
            </div>
            <div class="field center aligned">
                
            </div>
        </form>
    </div>
    <div class="actions">
        <button id="cancel_login_form3" class="ui red deny button">
            Annuler
        </button>
        <button id="submit_login_form3" class="ui green right button button" type="submit">Se connecter</button>
    </div>
</div>
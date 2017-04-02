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
    <div class="ui signin_contenair basic segment container">
        <div class="ui attached message">
            <div class="header"><?php echo __("Connexion", 'gpdealdomain') ?> </div>
            <p><?php echo __("Remplissez les informations ci-dessous pour se connecter", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">

                <form id="login_form2"  method="POST" class="ui form login_form" action="<?php echo get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))) ?>" style="margin-bottom: 1em" autocomplete="off">
                    <!--<p style="font-size: 12px">(<span style="color: red;">*</span>) Informations obligatoires</p>-->
                    <div class="field">
                        <label>Email ou pseudo <span style="color: red;">*</span></label>
                        <div class="ui input left icon">
                            <i class="user icon"></i>
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
                    <?php if (isset($_GET['redirect_to'])): ?>
                        <input type="hidden" name='redirect_to' value="<?php echo $_GET['redirect_to']; ?>" >
                    <?php endif ?>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="_remember" value="true">
                            <label>Se souvenir de moi</label>
                        </div>
                    </div>
                    <div class="field">
                        <div id="server_error_message2" class="ui negative message" style="display:none">
                            <i class="close icon"></i>
                            <div id="server_error_content2" class="header">Internal server error</div>
                        </div>
                        <div id="error_name_message2" class="ui error message" style="display: none">
                            <i class="close icon"></i>
                            <ul id="error_name_list2" class="list">

                            </ul>
                        </div>
                    </div>
                    <div class="field center aligned">
                        <button id="submit_login_form2" class="ui green fluid button" type="submit">Se connecter</button>
                    </div> 
                    <div class="field center aligned">
                        <a href="<?php echo get_permalink(get_page_by_path(__('mot-de-passe-oublie', 'gpdealdomain'))); ?>" ><?php echo __("Mot de passe oublié", "gpdealdomain") ?> ?</a>
                    </div>
                    <div class="field center aligned">
                        <span><?php echo __("Vous n'avez un compte", "gpdealdomain") ?> ? </span><a href="<?php echo get_permalink(get_page_by_path(__('inscription', 'gpdealdomain'))); ?>" ><?php echo __("S'inscrire", "gpdealdomain") ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


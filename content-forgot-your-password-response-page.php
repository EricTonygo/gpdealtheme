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
        <!--<div class="ui fluid card">-->
        <?php if(isset($_SESSION['success_send_password']) && $_SESSION['success_send_password'] == true): unset($_SESSION['success_send_password']);?>
                <div class="ui success message">
                    <div class="header"><?php echo __("Mot de passe envoyé avec succès !", "gpdealdomain"); ?></div>
                    <p>
                        Nous avons bien pris en compte votre demande de communication de mot de passe. Vos identifiants de connexion vous ont été envoyés par courrier electronique à l'adresse email de votre compte.
                    </p>
                </div>
        <?php elseif(isset($_SESSION['error_send_password']) && $_SESSION['error_send_password'] == true): unset($_SESSION['error_send_password']);?>
            <div class="ui error message">
                    <div class="header"><?php echo __("Erreur d'envoi !", "gpdealdomain"); ?></div>
                    <p>
                        Nous n'avons pas pu vous envoyer vos informations par courrier electronique car une erreur est survenue pendant le processus;
                    </p>
                </div>
        <?php endif ?>
       
        <!--</div>-->
    </div>
</div>


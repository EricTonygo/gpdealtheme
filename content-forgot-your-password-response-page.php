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
                <div class="ui success message">
                    <div class="header">Bonjour,</div>
                    <p>
                        Nous avons bien pris en compte votre demande de communication de mot de passe; vos identifiant de connexion vous ont été envoyés par mail à l'adresse email de votre compte.
                    </p>
                </div>
        <!--</div>-->
    </div>
</div>


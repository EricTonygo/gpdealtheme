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
        <div class="ui vertical masthead segment container">
            <!--div class="ui text container">
            </div-->
            <div class="ui stackable grid">

                <div class="twelve wide column">
                    <div id="content_search_carrier_form" class="ui fluid card">
                        <div class="content content_page">
                            <form id='contact_form' action="<?php the_permalink() ?>" class="ui form" autocomplete="off">
                                <?php if (!is_user_logged_in()): ?>
                                    <div class="inline fields">
                                        <div class="field myrole">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="role" value="particular" >
                                                <label>Particulier</label>
                                            </div>
                                        </div>
                                        <div class="field myrole">
                                            <div class="ui radio checkbox">
                                                <input id="redacteur" type="radio" name="role" value="professional">
                                                <label for="redacteur">Professionnel</label>
                                            </div>
                                        </div>
                                        <div class="field myrole">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="role" value="enterprise">
                                                <label>Entreprise</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="inline fields">
                                                <label>Déjà membre ? : </label>
                                                <div class="field">
                                                    <div class="ui radio checkbox">
                                                        <input type="radio" name="member" value="yes">
                                                        <label>Oui</label>
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <div class="ui radio checkbox">
                                                        <input type="radio" name="member" value="no">
                                                        <label>Non</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id='block_visitor'>
                                        <div class="fields">
                                            <div class="four wide field">
                                                <label>Civilité <span style="color:red;">*</span> </label>
                                            </div>
                                            <div class="twelve wide field">
                                                <div class="inline fields">
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            <input type="radio" name="civility" value="M">
                                                            <label>M</label>
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            <input type="radio" name="civility" value="Mme">
                                                            <label>Mme</label>
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            <input type="radio" name="civility" value="Mlle">
                                                            <label>Mlle</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="two fields">
                                            <div class="field">
                                                <label>Prenom</label>
                                                <input type="text" placeholder="Prenom" name="firstname">
                                            </div>

                                            <div class="field">
                                                <label>Nom <span style="color:red;">*</span></label>
                                                <input type="text" placeholder="Nom" name="lastname">
                                            </div>
                                        </div>

                                        <div class="two fields">
                                            <div class="field">
                                                <label>Fonction</label>
                                                <input type="text" placeholder="Fonction" name="function">
                                            </div>

                                            <div class="eight wide field">
                                                <label>Numero d'identification</label>
                                                <input type="text" placeholder="Numero d'identification de la société" name="company_identity_number">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label>Numéro de téléphone</label>
                                            <div class="fields">
                                                <div class="three wide field">
                                                    <select name="country_code">
                                                        <option value="+33">+33</option>
                                                        <option value="+237">+237</option>
                                                    </select>
                                                </div>
                                                <div class="thirteen wide field">
                                                    <input type="text" name="phone_number" placeholder="Numéro de téléphone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                    <div class="field">
                                        <label>Adresse Email <span style="color:red;">*</span></label>
                                        <input type="email" placeholder="Adresse Email" name="email">
                                    </div>
                                <?php endif ?>
                                <div class="field">
                                    <label>Raisons sociales</label>
                                    <input type="text" placeholder="Raisons sociales" name="social_reasons">
                                </div>
                                <div class="field">
                                    <label>Objet <span style="color:red;">*</span></label>
                                    <input type="text" placeholder="Objet" name="subject">
                                </div>

                                <div class="field">
                                    <label>Message <span style="color:red;">*</span></label>
                                    <textarea placeholder="Entrez votre message ici" name="message"></textarea>
                                </div>

                                <button id="submit_contact_form" class="ui right floated green button" type="submit"><i class="send icon"></i>Envoyer</button>
                            </form>
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
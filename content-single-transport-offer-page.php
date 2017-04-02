<?php
global $current_user;
get_template_part('top-menu', get_post_format());
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_type = array_map('intval', isset($_POST['transport_offer_package_type']) ? $_POST['transport_offer_package_type'] : array());
    $transport_method = array_map('intval', array(removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])))));
    $transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
    $transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
    $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
    $start_date = removeslashes(esc_attr(trim($_POST['start_date'])));
    $deadline_proposition = removeslashes(esc_attr(trim($_POST['start_deadline'])));
    $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
    $destination_date = removeslashes(esc_attr(trim($_POST['destination_date'])));
    $terms = removeslashes(esc_attr(trim($_POST['terms'])));
    $action = removeslashes(esc_attr(trim($_POST['action'])));
    $echo_start_city = $start_city;
    $echo_destination_city = $destination_city;
} else {
    $package_type = array_map('intval', wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "ids")));
    $transport_method = array_map('intval', wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "ids")));
    $transport_offer_price = get_post_meta(get_the_ID(), 'price', true);
    $transport_offer_currency = get_post_meta(get_the_ID(), 'currency', true);
    $start_country = get_post_meta(get_the_ID(), 'departure-country-transport-offer', true);
    $start_state = get_post_meta(get_the_ID(), 'departure-state-transport-offer', true);
    $start_city = get_post_meta(get_the_ID(), 'departure-city-transport-offer', true);
    $start_date = date_format(date_create_from_format('Y-m-d H:i:s', get_post_meta(get_the_ID(), 'date-of-departure-transport-offer', true)), 'd-m-Y');
    $deadline_proposition = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'deadline-of-proposition-transport-offer', true)));
    $destination_country = get_post_meta(get_the_ID(), 'destination-country-transport-offer', true);
    $destination_state = get_post_meta(get_the_ID(), 'destination-state-transport-offer', true);
    $destination_city = get_post_meta(get_the_ID(), 'destination-city-transport-offer', true);
    $destination_date = date('d-m-Y', strtotime(get_post_meta(get_the_ID(), 'arrival-date-transport-offer', true)));
    $action = removeslashes(esc_attr(trim($_GET['action'])));
    $echo_start_city = $start_state != "" ? $start_city . ", " . $start_state . ", " . $start_country : $start_city . ", " . $start_country;
    $echo_destination_city = $destination_state != "" ? $destination_city . ", " . $destination_state . ", " . $destination_country : $destination_city . ", " . $destination_country;
}
?>
<div class="ui large borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo home_url('/') ?>" class="section"><?php echo get_page_by_path(__('accueil', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain'))->post_title ?></a>
                <i class="right chevron icon divider"></i>
                <a href="<?php echo get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))) ?>" class="section"><?php echo get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))->post_title ?></a>
                <i class="right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">

    <div id='edit_transport_offer_infos' class="ui signup_contenair basic segment container" <?php if ($action == null || $action != 'edit'): ?> style="display: none;" <?php endif ?>>
        <div class="ui attached message">
            <div class="header"><?php echo __("Mofication de l' offre de transport", 'gpdealdomain') ?> : </div>
            <p><?php echo __("Modifier les informations ci-dessous de votre offre de transport puis enregistrer à nouveau.", 'gpdealdomain') ?></p>
        </div>
        <div class="ui fluid card">
            <div class="content">
                <div class="ui top attached tabular menu">
                    <a class="item active" data-tab="first">Offre de transport</a>
                    <a class="item" data-tab="second">Comment ça fonctionnne ?</a>
                </div>
                <div class="ui bottom attached tab segment active" data-tab="first">
                    <form id='write_transport_offer_form'  method="POST" action="<?php the_permalink(); ?>" class="ui form" autocomplete="off">

                        <h4 class="ui dividing header">DEPART <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <input id="start_city" type="text" name='start_city' placeholder="Ville de départ" value="<?php echo $start_city . ", " . $start_state . ", " . $start_country ?>">
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='start_date' placeholder="Date" value="<?php echo $start_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>

                        <h4 class="ui dividing header">DESTINATION <span style="color:red;">*</span></h4>
                        <div class="two wide fields">
                            <div class="field">
                                <input id="destination_city" type="text" name='destination_city' placeholder="Ville de destination" value="<?php echo $destination_city . ", " . $destination_state . ", " . $destination_country ?>">
                            </div>             
                            <div class="field">
                                <div class="ui calendar" >
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name='destination_date' placeholder="Date" value="<?php echo $destination_date ?>">
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <h4 class="ui dividing header">DATE LIMITE DE PROPOSITION <span style="color:red;">*</span></h4>
                        <div class="field">
                            <div class="ui calendar" >
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" name='start_deadline' placeholder="Date limite de proposition" value="<?php echo $deadline_proposition ?>">
                                </div>
                            </div>
                        </div>      
                        <h4 class="ui dividing header"><?php echo __("INFORMATIONS SUR L'OFFRE DE TRANSPORT", 'gpdealdomain') ?></h4>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Objet(s)", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <select name="transport_offer_package_type[]" class="ui search fluid dropdown" multiple="multiple" data-validate='transport_offer_package_type'>
                                    <option value="">Objets à transporter </option>
                                    <?php
                                    $typePackages = get_terms(array('taxonomy' => 'type_package', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($typePackages as $typePackage):
                                        ?>
                                        <option value="<?php echo $typePackage->term_id; ?>" <?php if (in_array($typePackage->term_id, $package_type, true)): ?> selected="selected" <?php endif ?>><?php echo $typePackage->name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __("Mode de transport", 'gpdealdomain') ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <?php
                                    $transportMethods = get_terms(array('taxonomy' => 'transport-method', 'hide_empty' => false, 'orderby' => 'ID', 'order' => 'ASC'));
                                    foreach ($transportMethods as $transportMethod):
                                        ?>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="transport_offer_transport_method" value="<?php echo $transportMethod->term_id; ?>" <?php if (in_array($transportMethod->term_id, $transport_method, true)): ?> checked="checked" <?php endif ?>>
                                                <label><?php echo $transportMethod->name; ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                                <label><?php echo __('Coût du transport', 'gpdealdomain'); ?> <span style="color:red;">*</span></label>
                            </div>
                            <div class="twelve wide field">

                                <div class="two wide fields">
                                    <div class="field">
                                        <input type="text" name="transport_offer_price" placeholder="Montant" value="<?php echo $transport_offer_price; ?>">
                                    </div>
                                    <div class="field">
                                        <select name="transport_offer_currency" class="ui search fluid dropdown">
                                            <option value="">Dévise</option>
                                            <?php
                                            $currencies = getCurrenciesList();
                                            foreach ($currencies as $currency) :
                                                ?>
                                                <option value="<?php echo $currency['code'] ?>" <?php if ($currency['code'] == $transport_offer_currency): ?> selected="selected" <?php endif ?>><?php echo $currency['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="inline field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="terms" <?php if ($terms == 'on' || is_user_logged_in()): ?> checked="checked" <?php endif ?>> 
                                <label><span style="color:red;">*</span> Je reconnais avoir pris de la liste des <a href="#">objets prohibés au transport</a>.</label>
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
                        <div class="field">
                            <input type="hidden" name='action' value='edit'>
                            <button id="cancel_edit_transport_offer_infos_btn" class="ui green button" >Annuler la modification</button>
                            <button id="submit_send_transport_offer" class="ui right floated green button" type="submit">Enregistrer l'offre</button>
                        </div>
                    </form>
                </div>
                <div class="ui bottom attached tab segment" data-tab="second"> 
                    Comment ça fonctionne
                </div>
            </div>
        </div>
    </div>
    <div id='show_transport_offer_infos' class="ui signup_contenair basic segment container" <?php if ($action && $action != 'show'): ?> style="display: none;" <?php endif ?> >
        <div  class="ui fluid card">
            <div class="content">
                <div class="ui form">
                    <h4 class="ui dividing header">DEPART </h4>
                    <div class="four wide fields">
                        <div class="field">
                            <label>Pays </label>
                            <span><?php echo $start_country; ?></span>
                        </div>
                        <div class="field">
                            <label>Région/Etat </label>
                            <span><?php echo $start_state; ?></span>
                        </div>
                        <div class="field">
                            <label>Ville </label>
                            <span><?php echo $start_city; ?></span>
                        </div>
                        <div class="field">
                            <label>Date</label>
                            <span><?php echo $start_date; ?></span>
                        </div>   
                    </div>

                    <h4 class="ui dividing header">DESTINATION </h4>
                    <div class="four wide fields">
                        <div class="field">
                            <label>Pays </label>
                            <span><?php echo $destination_country; ?></span>
                        </div>
                        <div class="field">
                            <label>Région/Etat </label>
                            <span><?php echo $destination_state; ?></span>
                        </div>
                        <div class="field">
                            <label>Ville </label>
                            <span><?php echo $destination_city; ?></span>
                        </div>
                        <div class="field">
                            <label>Date</label>
                            <span><?php echo $destination_date; ?></span>
                        </div>   
                    </div>
                    <h4 class="ui dividing header">DATE LIMITE DES PROPOSITIONS </h4>
                    <div class="fields">
                        <div class="field">
                            <span><?php echo $deadline_proposition; ?></span>
                        </div>   
                    </div>
                    <h4 class="ui dividing header">INFORMATIONS SUR LE COURRIER/COLIS</h4>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Objet(s) :</label>
                        </div>
                        <div class="twelve wide field">
                            <div class="inline fields">
                                <div class="field">
                                    <?php
                                    $package_type_list = wp_get_post_terms(get_the_ID(), 'type_package', array("fields" => "names"));
                                    $package_type_list_count = count($package_type_list);
                                    $j = 0;
                                    foreach ($package_type_list as $name) :
                                        ?>
                                        <?php if ($j < $package_type_list_count - 1) : ?>
                                            <span><?php echo $name; ?>, </span>
                                        <?php else: ?>
                                            <span><?php echo $name; ?></span>
                                        <?php endif ?>
                                        <?php
                                        $j++;
                                    endforeach
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Mode de transport :</label>
                        </div>
                        <div class="twelve wide field">
                            <div class="inline fields">
                                <div class="field">
                                    <?php
                                    $transport_method_list = wp_get_post_terms(get_the_ID(), 'transport-method', array("fields" => "names"));
                                    $transport_method_list_count = count($transport_method_list);
                                    $i = 0;
                                    foreach ($transport_method_list as $name) :
                                        ?>
                                        <?php if ($i < $transport_method_list_count - 1) : ?>
                                            <span><?php echo $name; ?>, </span>
                                        <?php else: ?>
                                            <span><?php echo $name; ?></span>
                                        <?php endif ?>
                                        <?php
                                        $i++;
                                    endforeach
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <h4 class="ui dividing header">INFORMATIONS SUR LE TRANSPORT</h4>
                    <div class="fields">
                        <div class="four wide field">
                            <label>Statut :</label>
                        </div>
                        <div class="twelve wide field">
                            <div class="inline fields">
                                <div class="field">
                                    <span><?php echo getTransportStatus(intval(get_post_meta(get_the_ID(), 'transport-state', true))); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $package_ids = get_post_meta(get_the_ID(), 'packages-IDs', true);
                    if (is_array($package_ids)) {
                        $package_ids = array_map('intval', $package_ids);
                    } else {
                        $package_ids = null;
                    }
                    ?>
                    <h4 class="ui dividing header" style="text-transform: uppercase;">COURRIERS/COLIS transportés</h4>
                    <div class="fields">
                        <?php if ($package_ids): ?>
                            <div class="four wide field">
                                <label>Numéros de courriers :</label>
                            </div>
                            <div class="twelve wide field">
                                <div class="inline fields">
                                    <div class="field">
                                        <?php
                                        $package_ids_count = count($package_ids);
                                        $i = 0;
                                        foreach ($package_ids as $id) :
                                            $post_author = get_post_field('post_author', $id);
                                            ?>                                        
                                            <?php if ($i < $package_ids_count - 1) : ?>
                                                <span><a href="<?php the_permalink($id) ?>"><?php
                                                        echo $id;
                                                        echo get_post_meta($id, 'package-number', true);
                                                        ?></a>, </span>
                                            <?php else: ?>
                                                <span><a href="<?php the_permalink($id) ?>"><span><?php
                                                            echo $id;
                                                            echo get_post_meta($id, 'package-number', true);
                                                            ?></a></span>
                                                <?php endif ?>
                                                <?php
                                                $i++;
                                            endforeach
                                            ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="field" style="margin-top: 4em">
                        <button id="edit_transport_offer_infos_btn" class="ui right floated green button" >Modifier l'offre</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='evaluations' class="ui signup_contenair basic segment container" <?php if ($action == null || $action != 'evaluate'): ?> style="display: none;" <?php endif ?>>
        <div  class="ui fluid card">
            <div class="content">
                <div class="ui form">
                    <h4 class="ui dividing header">DEPART </h4>
                    <div class="four wide fields">
                        <div class="field">
                            <label>Pays </label>
                            <span><?php echo $start_country; ?></span>
                        </div>
                        <div class="field">
                            <label>Région/Etat </label>
                            <span><?php echo $start_state; ?></span>
                        </div>
                        <div class="field">
                            <label>Ville </label>
                            <span><?php echo $start_city; ?></span>
                        </div>
                        <div class="field">
                            <label>Date</label>
                            <span><?php echo $start_date; ?></span>
                        </div>   
                    </div>

                    <h4 class="ui dividing header">DESTINATION </h4>
                    <div class="four wide fields">
                        <div class="field">
                            <label>Pays </label>
                            <span><?php echo $destination_country; ?></span>
                        </div>
                        <div class="field">
                            <label>Région/Etat </label>
                            <span><?php echo $destination_state; ?></span>
                        </div>
                        <div class="field">
                            <label>Ville </label>
                            <span><?php echo $destination_city; ?></span>
                        </div>
                        <div class="field">
                            <label>Date</label>
                            <span><?php echo $destination_date; ?></span>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
        <?php
        $transport_offer_link = get_the_permalink();
        $evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
        $current_user_evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => 1, "post_status" => 'publish', 'author' => $current_user->ID, 'meta_query' => array(array('key' => 'transport-offer-ID', 'value' => get_the_ID(), 'compare' => '='))));
        ?>
        <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$evaluations->have_posts()): ?>
            <div id="action_evaluate_top" class="ui fluid card" style="margin-bottom: 1em; box-shadow: none">
                <div class="field">
                    <!--<a id="close_transport_offer_top" href="<?php the_permalink() ?>" class="ui red icon button right floated close_transport_offer"><i class="checkmark icon"></i><?php echo __("Cloturer l'offre", "gpdealdomain") ?></a>-->
                    <a id="show_block_evaluation_form_top" <?php if ($evaluations->have_posts()): ?> href="#action_evaluate_down"<?php else: ?> href="#block_evaluation_form" <?php endif ?> onclick="show_block_evaluation_form_top()" class="ui green button right floated"><?php echo __("Evaluer l'offre", "gpdealdomain") ?></a>                
                </div>
            </div>
        <?php endif ?>

        <div id="content_evaluations" class="ui fluid card">
            <div class="content center aligned">
                <div class="header"><?php echo __("Les évaluations de l'offre", "gpdealdomain"); ?></div>
            </div>
            <div class="content">
                <div class="ui fluid card">
                    <div class="content">
                        <div  class="ui form" >
                            <?php
                            $statistics = getTotalStatistiticsEvaluation(get_the_ID());
                            foreach ($statistics as $stat_key => $stat_value):
                                ?>
                                <div class="inline fields">
                                    <label><?php echo $stat_key; ?> ?</label>
                                    <?php foreach ($stat_value as $key => $value): ?>
                                        <?php if ($key != "vote_count"): ?>
                                            <div class="field">
                                                <label><?php echo $key ?> : </label>
                                                <span><?php echo $value; ?>%</span>
                                            </div>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
                if ($evaluations->have_posts()) {
                    while ($evaluations->have_posts()): $evaluations->the_post();
                        $evaluate_user = get_userdata(get_post_field('post_author', get_the_ID()));
                        $comments_list = get_comments(array('post_id' => get_the_ID(), "parent" => 0, "orderby" => "comment_date", "order" => "asc"));
                        $questions = get_post_meta(get_the_ID(), 'questions', true);
                        $responses = get_post_meta(get_the_ID(), 'responses', true);
                        $current_user_comments_count = get_comments(array('post_id' => get_the_ID(), "user_id" => $current_user->ID, 'count' => true));
                        ?>
                        <div class="ui form">
                            <div class="ui fluid card">
                                <div class="content">
                                    <div class=""><img class="ui avatar image" src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"><?php echo $evaluate_user->user_login ?>

                                        <span class="meta"><?php echo "a évalué il y a " . human_time_diff(get_the_time('U'), current_time('timestamp')); ?></span>

                                    </div>
                                </div>
                                <?php
                                if (is_array($questions) && is_array($responses) && count($questions) == 5 && count($responses) == 5):
                                    ?>
                                    <div class="content ui form">
                                        <div class="three fields" >
                                            <?php for ($i = 0; $i < 3; $i++): ?>
                                                <div class="inline fields">
                                                    <label><?php echo $questions[$i] . " :"; ?></label>
                                                    <div class="field">
                                                        <label><?php echo $responses[$i]; ?></label>
                                                    </div>
                                                </div>
                                            <?php endfor ?>
                                        </div>
                                        <div class="two fields" >
                                            <?php for ($i = 3; $i < 5; $i++): ?>
                                                <div class="inline fields">
                                                    <label><?php echo $questions[$i] . " :"; ?></label>
                                                    <div class="field">
                                                        <label><?php echo $responses[$i]; ?></label>
                                                    </div>
                                                </div>
                                            <?php endfor ?>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>

                            <h4 class="ui dividing header">COMMENTAIRES </h4>
                            <div class="ui comments">
                                <?php if ($comments_list): ?>
                                    <?php
                                    foreach ($comments_list as $comment):
                                        $comment_user = get_userdata($comment->user_id);
//                                    $comments_children = get_comments(array('post_id' => get_the_ID(), "parent" => $comment->comment_ID));
//                                    var_dump($comments_children);
                                        ?>

                                        <div class="comment">
                                            <a class="avatar">
                                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png">
                                            </a>
                                            <div class="content">
                                                <a class="author"><?php echo $comment_user->user_login; ?></a>
                                                <div class="metadata">
                                                    <div class="date"><?php
                                                        $date = apply_filters('get_comment_time', $comment->comment_date, 'U', false, true, $comment);
                                                        echo "a commenté il y a " . human_time_diff(strtotime($date), current_time('timestamp'));
                                                        ?></div>
                                                </div>
                                                <div class="text">
                                                    <p><?php echo $comment->comment_content; ?></p>
                                                </div>
                                                <?php if ($current_user_comments_count == 0): ?>
                                                    <div class="actions">
                                                        <a id="show_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="show_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply"><?php echo __("Répondre", "gpdealdomain") ?></a>
                                                        <a id="hide_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="hide_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply" style="display: none"><?php echo __("Annuler", "gpdealdomain") ?></a>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                            <?php echo getAndechoAllReply(get_the_ID(), $comment->comment_ID, $transport_offer_link); ?>
                                        </div>
                                        <?php if ($current_user_comments_count == 0): ?>
                                            <form id="comment_reply_form<?php echo $comment->comment_ID; ?>" class="ui reply form add_comment_reply_form" method="POST" action="<?php echo $transport_offer_link; ?>" onsubmit="add_comment_reply(event, <?php echo $comment->comment_ID; ?>)" style="display:none">
                                                <div class="field">
                                                    <textarea name="comment_content"></textarea>
                                                </div>
                                                <input type="hidden" name="action" value="add-comment-reply">
                                                <input type="hidden" name="evaluation_id" value="<?php the_ID(); ?>">
                                                <input type="hidden" name="comment_parent_id" value="<?php echo $comment->comment_ID; ?>">
                                                <div class="field">
                                                    <div id="server_error_message<?php echo $comment->comment_ID; ?>" class="ui negative message" style="display:none">
                                                        <i class="close icon"></i>
                                                        <div id="server_error_content<?php echo $comment->comment_ID; ?>" class="header">Internal server error</div>
                                                    </div>
                                                    <div id="error_name_message<?php echo $comment->comment_ID; ?>" class="ui error message" style="display: none">
                                                        <i class="close icon"></i>
                                                        <div id="error_name_header<?php echo $comment->comment_ID; ?>" class="header"></div>
                                                        <ul id="error_name_list<?php echo $comment->comment_ID; ?>" class="list">

                                                        </ul>
                                                    </div>
                                                </div>
                                                <button class="ui blue submit icon button">
                                                    <i class="icon edit"></i> Repondre
                                                </button>
                                            </form>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                <?php endif ?>
                                <?php if ($current_user_comments_count == 0): ?>
                                    <form id="evaluation_comment_form<?php the_ID(); ?>" class="ui reply form add_comment_form" method="POST" action="<?php echo $transport_offer_link; ?>" onsubmit="add_evaluation_comment(event, <?php the_ID(); ?>)" style="display:none">
                                        <div class="field">
                                            <textarea name="comment_content"></textarea>
                                        </div>
                                        <input type="hidden" name="action" value="add-evaluation-comment">
                                        <input type="hidden" name="evaluation_id" value="<?php the_ID(); ?>">
                                        <div class="field">
                                            <div id="server_error_message<?php the_ID(); ?>" class="ui negative message" style="display:none">
                                                <i class="close icon"></i>
                                                <div id="server_error_content<?php the_ID(); ?>" class="header">Internal server error</div>
                                            </div>
                                            <div id="error_name_message<?php the_ID(); ?>" class="ui error message" style="display: none">
                                                <i class="close icon"></i>
                                                <div id="error_name_header<?php the_ID(); ?>" class="header"></div>
                                                <ul id="error_name_list<?php the_ID(); ?>" class="list">

                                                </ul>
                                            </div>
                                        </div>
                                        <button type="submit" class="ui primary submit icon button">
                                            <i class="icon edit"></i>
                                            Ajouter un commentaire
                                        </button>
                                        <div id="hide_evaluation_comment_form<?php the_ID(); ?>" onclick="hide_evaluation_comment_form(<?php echo the_ID(); ?>)" class="ui black button"><?php echo __("Annuler", "gpdealdomain") ?></div>
                                    </form>
                                </div>
                                <div class="actions" style="margin-bottom: 1em">
                                    <a id="show_evaluation_comment_form<?php the_ID(); ?>" onclick="show_evaluation_comment_form(<?php echo the_ID(); ?>)" class="ui green button"><?php echo __("Commenter l'évaluation", "gpdealdomain") ?></a>
                                </div>
                            <?php endif ?>
                        </div>
                        <?php
                    endwhile;
                } else {
                    ?>
                    <div class="">
                        <div class="ui warning message">
                            <div class="content">
                                <div class="header" style="font-weight: normal;">
                                    Aucune évaluation de cette offre pour l'instant.
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <?php if ($evaluations->have_posts() && get_post_field('post_author', get_the_ID()) != $current_user->ID && !$evaluations->have_posts()) : ?>
            <div id="action_evaluate_down" class="ui fluid card" style="margin-bottom: 1em; box-shadow: none">
                <div class="field">
                    <!--<a id="close_transport_offer_down"  href="<?php the_permalink() ?>" class="ui red icon button right floated close_transport_offer"><i class="checkmark icon"></i><?php echo __("Cloturer l'offre", "gpdealdomain") ?></a>-->
                    <a id="show_block_evaluation_form" href="#action_evaluate_down" onclick="show_block_evaluation_form()" class="ui green button right floated"><?php echo __("Evaluer l'offre", "gpdealdomain") ?></a>                
                </div>
            </div>
        <?php endif; ?>
        <?php if (get_post_field('post_author', get_the_ID()) != $current_user->ID && !$evaluations->have_posts()): ?>
            <div id="block_evaluation_form" class="ui fluid card" style="display: none">
                <div class="content">
                    <form id="evaluation_form" class="ui form" action="<?php the_permalink() ?>" method="POST">
                        <div class="two fields" >
                            <div class="inline fields">
                                <label>Objets livrés ?</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="item_delivred" value="Oui">
                                        <label>Oui</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="item_delivred" value="Non">
                                        <label>Non</label>
                                    </div>
                                </div>
                            </div>

                            <div class="inline fields">
                                <label>Etat des objets ?</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="item_state" value="Conforme">
                                        <label>Conforme</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="item_state" value="Non conforme">
                                        <label>Non conforme</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields" >
                            <div class="inline fields">
                                <label>Délais livraison  ?</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="delivry_time" value="Satisfaisant">
                                        <label>Satisfaisant</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="delivry_time" value="Moyen">
                                        <label>Moyen</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="delivry_time" value="Non satisfaisant">
                                        <label>Non satisfaisant</label>
                                    </div>
                                </div>
                            </div>
                            <div class="inline fields">
                                <label>Coût ?</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="cost" value="Economique">
                                        <label>Economique</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="cost" value="Juste">
                                        <label>Juste</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="cost" value="Elevé">
                                        <label>Elevé</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields" >
                            <div class="inline fields">
                                <label>Transporteur à recommander ?</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="recommended_carrier" value="Pas du tout">
                                        <label>Pas du tout</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="recommended_carrier" value="Moyennement">
                                        <label>Moyennement</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="recommended_carrier" value="Tout le temps">
                                        <label>Tout le temps</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="ui dividing header">LAISSER UN COMMENTAIRE </h4>
                        <div class="field">
                            <textarea name="comment_content"></textarea>
                        </div>
                        <input type="hidden" name="action" value="evaluate" >
                        <div class="ui error message"><ul class="list"><li><?php echo __("Veuillez s'il vous plait répondre à toutes les questions", "gpdealdomain"); ?></li></ul></div>
                        <div class="field">                       
                            <div id="hide_block_evaluation_form" onclick="hide_block_evaluation_form()" class="ui black button right floated"><?php echo __("Annuler", "gpdealdomain") ?></div>
                            <button id="submit_evaluation_form" type="submit" class="ui submit primary button right floated">Evaluer</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>


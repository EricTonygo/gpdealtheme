<?php

if (is_user_logged_in()) {
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "evaluate") {
            $item_delivred = removeslashes(esc_attr(trim($_POST['item_delivred'])));
            $item_state = removeslashes(esc_attr(trim($_POST['item_state'])));
            $delivry_time = removeslashes(esc_attr(trim($_POST['delivry_time'])));
            $cost = removeslashes(esc_attr(trim($_POST['cost'])));
            $recommended_carrier = removeslashes(esc_attr(trim($_POST['recommended_carrier'])));
            $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
            $evaluation_data = array(
                "responses" => array($item_delivred, $item_state, $delivry_time, $cost, $recommended_carrier),
                'comment_content' => $comment_content
            );

            $evaluation_id = evaluateTransportOffer($evaluation_data);
            if (is_wp_error($evaluation_id)) {
                $json = array("message" => "Impossible d'ajouter votre evaluation. Une erreur s'est produite");
                return wp_send_json_error($json);
            }
            $json = array("message" => "Evaluation ajoutée avec succès !");
            return wp_send_json_success($json);
        }elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-evaluation-comment" && isset($_POST["evaluation_id"])) {
            $evaluation_id = intval(removeslashes(esc_attr(trim($_POST['evaluation_id']))));
            $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
            $comment_id = add_evaluation_comment($evaluation_id, $comment_content);
            if ($comment_id == null || is_wp_error($comment_id)) {
                $json = array("message" => "Impossible d'ajouter le commentaire à cette evaluation.");
                return wp_send_json_error($json);
            }
            $json = array("message" => "Commentaire ajouté avec succès !");
            return wp_send_json_success($json);
        }elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-comment-reply" && isset($_POST["evaluation_id"]) && isset($_POST["comment_parent_id"])) {
            $evaluation_id = intval(removeslashes(esc_attr(trim($_POST['evaluation_id']))));
            $comment_parent_id = intval(removeslashes(esc_attr(trim($_POST['comment_parent_id']))));
            $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
            $comment_id = add_comment_reply($evaluation_id, $comment_parent_id, $comment_content);
            if ($comment_id == null || is_wp_error($comment_id)) {
                $json = array("message" => "Impossible d'ajouter la réponse à cette commentaire.");
                return wp_send_json_error($json);
            }
            $json = array("message" => "Réponse ajoutée avec succès !");
            return wp_send_json_success($json);
        }elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "close") {
            $evaluation_id = intval(removeslashes(esc_attr(trim($_POST['evaluation_id']))));
            $comment_parent_id = intval(removeslashes(esc_attr(trim($_POST['comment_parent_id']))));
            $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
            $comment_id = add_comment_reply($evaluation_id, $comment_parent_id, $comment_content);
            if ($comment_id == null || is_wp_error($comment_id)) {
                $json = array("message" => "Impossible d'ajouter la réponse à cette commentaire.");
                return wp_send_json_error($json);
            }
            $json = array("message" => "Réponse ajoutée avec succès !");
            return wp_send_json_success($json);
        } elseif (isset($_POST['transport_offer_package_type']) && isset($_POST['transport_offer_transport_method']) && isset($_POST['transport_offer_price']) && isset($_POST['transport_offer_currency']) && isset($_POST['start_city']) && isset($_POST['start_date']) && isset($_POST['start_deadline']) && isset($_POST['destination_city']) && isset($_POST['destination_date']) && isset($_POST['terms'])) {
            $package_type = array_map('intval', $_POST['transport_offer_package_type']);
            $transport_method = removeslashes(esc_attr(trim($_POST['transport_offer_transport_method'])));
            $transport_offer_price = removeslashes(esc_attr(trim($_POST['transport_offer_price'])));
            $transport_offer_currency = removeslashes(esc_attr(trim($_POST['transport_offer_currency'])));
            $start_city = removeslashes(esc_attr(trim($_POST['start_city'])));
            $start_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_date']))))));
            $start_deadline = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['start_deadline']))))));
            $destination_city = removeslashes(esc_attr(trim($_POST['destination_city'])));
            $destination_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', removeslashes(esc_attr(trim($_POST['destination_date']))))));
            $transport_offer_data = array(
                'transport_offer_package_type' => $package_type,
                'transport_offer_transport_method' => $transport_method,
                'transport_offer_price' => $transport_offer_price,
                'transport_offer_currency' => $transport_offer_currency,
                'start_city' => $start_city,
                'start_date' => $start_date,
                'start_deadline' => $start_deadline,
                'destination_city' => $destination_city,
                'destination_date' => $destination_date
            );
            $transport_offer_id = updateTransportOffer(get_the_ID(), $transport_offer_data);
            if (!is_wp_error($transport_offer_id)) {
                wp_safe_redirect(get_permalink(get_page_by_path(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain'))));
                exit;
            }
        } else {
            
        }
        get_header();
        get_template_part('content-single-transport-offer-page', get_post_format());
        get_footer();
    } elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
        get_header();
        get_template_part('content-single-transport-offer-page', get_post_format());
        get_footer();
    } else {
        get_header();
        get_template_part('content-single-transport-offer-page', get_post_format());
        get_footer();
    }
} else {
    wp_safe_redirect(esc_url(add_query_arg(array('redirect_to' => get_the_permalink()), get_permalink(get_page_by_path(__('connexion', 'gpdealdomain'))))));
}
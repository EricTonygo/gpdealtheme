<?php
global $current_user;
?>
<div id="show-reviews-evaluations-carrier" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <?php echo __("Avis/Evaluations", "gpdealdomain"); ?>
    </div>
    <div class="content">
        <?php
        $evaluations = new WP_Query(array('post_type' => 'evaluation', 'post_per_page' => -1, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'meta_query' => array(array('key' => 'carrier-author', 'value' => $carrier_id, 'compare' => '='))));
        if ($evaluations->have_posts()) {
            ?>
            <div class="ui fluid card">
                <div class="content">
                    <div  class="ui form" >
                        <?php
                        $statistics = getTotalStatistiticsEvaluationsOfCarrier($carrier_id);
                        foreach ($statistics as $stat_key => $stat_value):
                            ?>
                            <div class="two fields">
                                <div class="four wide field"><span style="font-weight: bold"><?php echo $stat_key; ?> <span style="color:#2185d0; font-weight: bold"><?php echo $stat_value["vote_count"]; ?> avis</span> :</span></div>
                                <div class="twelve wide field disable">
                                    <div class="ui huge star rating" data-rating="<?php echo $stat_value["weighted_average"]; ?>" data-max-rating="5"></div>
                                    <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
            while ($evaluations->have_posts()): $evaluations->the_post();
                $post_author = get_post_field('post_author', get_the_ID());
                $evaluate_user = get_userdata($post_author);
                $comments_list = get_comments(array('post_id' => get_the_ID(), "parent" => 0, "orderby" => "comment_date", "order" => "asc"));
                $questions = get_post_meta(get_the_ID(), 'questions', true);
                $responses = get_post_meta(get_the_ID(), 'responses', true);
                $profile_picture_id = get_user_meta($post_author, 'profile-picture-ID', true) ? get_user_meta($post_author, 'profile-picture-ID', true) : get_user_meta($post_author, 'company-logo-ID', true);
                ?>
                <div class="ui form">
                    <div class="ui fluid card">
                        
                        <div class="content">
                            <div class=""><img  class="ui avatar image" <?php if ($profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>><span style="font-weight: bold"><a onclick="show_user_evaluation(<?php the_ID(); ?>)"><?php echo $evaluate_user->user_login ?></a></span>

                                <span class="meta"><?php echo "a évalué il y a " . human_time_diff(get_the_time('U'), current_time('timestamp')); ?></span>

                            </div>
                        </div>
                        <?php
                        if (is_array($questions) && is_array($responses) && count($questions) == 5 && count($responses) == 5):
                            ?>
                            <div id="content_evaluation_<?php the_ID(); ?>" class="content ui form" style="display: none;">
                                <?php for ($i = 0; $i < 2; $i++): ?>
                                    <div class="two fields" >
                                        <div class="four wide field"><label><?php echo $questions[$i]; ?> :</label></div>
                                        <div class="twelve wide field">
                                            <label style="margin-left: 7em;"><?php echo $responses[$i]; ?></label>
                                        </div>
                                    </div>
                                <?php endfor ?>

                                <div class="fields">
                                    <div class="four wide field"><label><?php echo $questions[2]; ?> :</label></div>
                                    <div class="twelve wide field disable">
                                        <div class="ui huge star rating" data-rating="<?php echo $responses[2]; ?>" data-max-rating="5"></div>
                                        <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="four wide field"><label><?php echo $questions[3]; ?> :</label></div>
                                    <div class="twelve wide field disable">
                                        <div class="ui huge star rating" data-rating="<?php echo $responses[3]; ?>" data-max-rating="5"></div>
                                        <div class="sub-title-rating"><span class="left-sub-title-rating">Onéreux</span> <span class="right-sub-title-rating">Economique</span></div>
                                    </div>
                                </div>

                                <div class="fields">
                                    <div class="four wide field"><label><?php echo $questions[4]; ?> :</label></div>
                                    <div class="twelve wide field disable">
                                        <div class="ui huge star rating" data-rating="<?php echo $responses[4]; ?>" data-max-rating="5"></div>
                                        <div class="sub-title-rating"><span class="left-sub-title-rating">Insatisfait</span> <span class="right-sub-title-rating">Très satisfait</span></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>

                    <h4 class="ui dividing header">Commentaires </h4>
                    <div class="ui comments">
                        <?php if ($comments_list): ?>
                            <?php
                            foreach ($comments_list as $comment):
                                $comment_user = get_userdata($comment->user_id);
//                                    $comments_children = get_comments(array('post_id' => get_the_ID(), "parent" => $comment->comment_ID));
//                                    var_dump($comments_children);
                                $comment_profile_picture_id = get_user_meta($comment->user_id, 'profile-picture-ID', true) ? get_user_meta($comment->user_id, 'profile-picture-ID', true) : get_user_meta($comment->user_id, 'company-logo-ID', true);
                                ?>

                                <div class="comment">
                                    <a class="avatar">
                                        <img  class="ui avatar image" <?php if ($comment_profile_picture_id): ?> src= "<?php echo wp_get_attachment_url($comment_profile_picture_id); ?>" <?php else: ?> src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"<?php endif ?>>
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
                                    </div>
                                    <?php echo getAndEchoAllReplyForCarrier(get_the_ID(), $comment->comment_ID); ?>
                                </div>

                            <?php endforeach; ?>
                        <?php endif ?>
                    </div>   
                </div>
        <div class="ui fitted divider" style="margin-bottom: 1em"></div>
                <?php
            endwhile;
        } else {
            ?>
            <div class="">
                <div class="ui warning message">
                    <div class="content">
                        <div class="header" style="font-weight: normal;">
                            Aucune évaluation de ce transporteur est disponible pour l'instant.
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Fermer
        </div>
    </div>
</div>
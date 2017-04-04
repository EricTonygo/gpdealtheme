<?php
global $current_user;
?>
<div id="show-reviews-evaluations-carrier" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <?php echo __("Avis et évaluations du transporteur ", "gpdealdomain") . get_the_author_meta('user_login', $carrier_id); ?>
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
            while ($evaluations->have_posts()): $evaluations->the_post();
                $evaluate_user = get_userdata(get_post_field('post_author', get_the_ID()));
                $comments_list = get_comments(array('post_id' => get_the_ID(), "parent" => 0, "orderby" => "comment_date", "order" => "asc"));
                $questions = get_post_meta(get_the_ID(), 'questions', true);
                $responses = get_post_meta(get_the_ID(), 'responses', true);
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
                                    </div>
                                    <?php echo getAndEchoAllReplyForCarrier(get_the_ID(), $comment->comment_ID); ?>
                                </div>

                            <?php endforeach; ?>
                        <?php endif ?>
                    </div>   
                </div>
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
<?php get_template_part('top-menu', get_post_format()); ?>
<div class="ui tiny borderless second-nav menu">
    <div class="ui container center aligned">
        <div class="center menu">
            <div class="item">
                <a href="<?php echo wp_make_link_relative(home_url('/')); ?>" class="section"><?php echo get_page_by_path(__('home', 'gpdealdomain'))->post_title ?></a>                
                <i class="small right arrow icon divider"></i>
                <div class="active section"><?php the_title(); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="ui vertical masthead  segment container">
    <div class="ui stackable grid">
        <div class="wide column">
            <div  class="ui content_packages_transports fluid card content_without_white">
                <div class="content">
                    <div class="ui icon success message">
                        <i class="checkmark green icon"></i>
                        <div class="content">
                            <div class="header">
                                <?php echo $success_registration_message_title; ?>
                            </div>
                            <p><?php echo $success_registration_message_content; ?>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
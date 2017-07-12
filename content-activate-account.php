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
            <div  class="ui content_packages_transports fluid card">
                <div class="content">
                    <?php if ($activation_message != ""): ?>
                        <?php if ($account_activated == true): ?>
                            <div class="ui success message">
                                <div class="content">
                                    <div class="header" style="font-weight: normal;">
                                        <?php echo $activation_message; ?>.
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="ui error message">
                                <div class="content">
                                    <div class="header" style="font-weight: normal;">
                                        <?php echo $activation_message; ?>.
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
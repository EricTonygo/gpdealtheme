<div id="menu_top_footer" class="ui inverted menu">
    <div class="ui container">
        <div id="left_menu_top_footer" class="left menu">
            <form action="<?php echo wp_make_link_relative(get_site_url() . '/'); ?>" method="GET">
                <div class="item search_item">               
                    <div class="ui icon input">                    
                        <input type="text" name="s" placeholder="<?php _e("Search information", "gpdealdomain") ?>..." value="<?php
                        if (isset($_GET['s'])) {
                            echo stripslashes($_GET['s']);
                        }
                        ?>">                   
                        <i class="search icon"></i>
                    </div>               
                </div>
            </form>
        </div>
        <div class="right menu">
            <a class="item" title="Suivez nous sur facebook">
                <i class="facebook f large icon"></i>
            </a>
            <a class="item" title="Suivez nous sur twitter">
                <i class="twitter large icon"></i>
            </a>
        </div>
    </div>
</div>
<div class="ui vertical footer segment">
    <div class="ui container">
        <div class="ui stackable inverted divided equal height stackable grid">
            <div class="four wide column center aligned">
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('legal-notices', 'gpdealdomain')))); ?>" class="ui item"><?php echo get_page_by_path(__('legal-notices', 'gpdealdomain'))->post_title ?></a>
            </div>
            <div class="four wide column center aligned">
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('terms-of-use', 'gpdealdomain')))) ?>" class="ui item"> <?php echo get_page_by_path(__('terms-of-use', 'gpdealdomain'))->post_title ?> </a>
            </div>
            <div class="four wide column center aligned">
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('contact-us', 'gpdealdomain')))); ?>" class="ui item"> <?php echo get_page_by_path(__('contact-us', 'gpdealdomain'))->post_title ?> </a>
            </div>
            <div class="four wide column center aligned">
                <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('blog', 'gpdealdomain')))); ?>" class="ui item"> <?php echo __("Blog", "gpdealdomain"); ?> </a>
            </div>
        </div>
        <div class="ui stackable inverted divided equal height stackable grid center aligned">
            <div class="five wide column center aligned">
                <div class="ui inverted" style="font-size: 9pt">&copy;2017 - <a  href="<?php echo home_url('/') ?>">Global Parcel Deal<sup style="font-size: 8pt">&reg;</sup></a> - <?php _e('All rights reserved', 'gpdealdomain'); ?></div>
            </div>
        </div>
    </div>
</div>
</div>
<?php wp_footer() ?>

<?php if (is_page(__('registration', 'gpdealdomain')) || is_page(__('registration', 'gpdealdomain') . '/' . __('account-summary', 'gpdealdomain'))): ?>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=<?php echo pll_current_language('slug'); ?>"
            async defer>
    </script>   
<?php endif ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsKRohVxC2BavLF5MeV93AKVDkkJaE0mU&libraries=places&language=en"></script>
<script>
            var input = document.getElementById('q');
            var options = {
                //bounds: defaultBounds,
                types: ['(cities)']
            };
            autocomplete = new google.maps.places.Autocomplete(input, options);
            var input_mobile = document.getElementById('q_mobile');
            var options = {
                //bounds: defaultBounds,
                types: ['(cities)']
            };
            autocomplete_mobile = new google.maps.places.Autocomplete(input_mobile, options);
</script>
<?php if (is_home() || is_front_page() || is_page(__('search-for-transport-offers', 'gpdealdomain')) || is_page(__('search-for-unsatisfied-shipments', 'gpdealdomain'))): ?>
    <script>
        var input1 = document.getElementById('start_city_transport');
        var input2 = document.getElementById('destination_city_transport');
        var input3 = document.getElementById('start_city_package');
        var input4 = document.getElementById('destination_city_package');
        var options = {
            //bounds: defaultBounds,
            types: ['(cities)']
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
        autocomplete2 = new google.maps.places.Autocomplete(input2, options);
        autocomplete3 = new google.maps.places.Autocomplete(input3, options);
        autocomplete4 = new google.maps.places.Autocomplete(input4, options);
    </script>
<?php endif ?>
<?php if (is_page(__('my-account', 'gpdealdomain') . '/' . __('shipments', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')) || is_singular('package') || is_page(__('my-account', 'gpdealdomain') . '/' . __('transport-offers', 'gpdealdomain') . '/' . __('write', 'gpdealdomain')) || is_singular('transport-offer')):
    ?>
    <script>
        var input1 = document.getElementById('start_city');
        var input2 = document.getElementById('destination_city');
        var options = {
            //bounds: defaultBounds,
            types: ['(cities)']
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
        autocomplete2 = new google.maps.places.Autocomplete(input2, options);
    </script>
<?php endif ?>

<?php if (is_page(__('registration', 'gpdealdomain') . '/' . __('account-summary', 'gpdealdomain')) || is_page(__('my-account', 'gpdealdomain') . '/' . __('profile', 'gpdealdomain'))): ?>
    <script>
        var input1 = document.getElementById('locality');
        var input2 = document.getElementById('locality_pro');
        var options = {
            //bounds: defaultBounds,
            types: ['(cities)']
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
        autocomplete2 = new google.maps.places.Autocomplete(input2, options);
    </script>
<?php endif ?>
</body>
</html>
<div class="ui vertical footer segment" style="margin-top: 3em">
    <div class="ui container">
        <div class="ui stackable inverted divided equal height stackable grid">
            <div class="five wide column center aligned">
                <a href="<?php echo get_permalink(get_page_by_path(__('mentions-legales', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('mentions-legales', 'gpdealdomain'))): ?> active_menu <?php endif ?>  item"><?php echo get_page_by_path(__('mentions-legales', 'gpdealdomain'))->post_title ?></a>
            </div>
            <div class="six wide column center aligned">
                <a href="<?php echo get_permalink(get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('conditions-dutilisation', 'gpdealdomain'))): ?> myactive <?php endif ?> item"> <?php echo get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))->post_title ?> </a>
            </div>
            <div class="five wide column center aligned">
                <a href="<?php echo get_permalink(get_page_by_path(__('nous-contacter', 'gpdealdomain'))) ?>" class="ui <?php if (is_page(__('nous-contacter', 'gpdealdomain'))): ?> myactive <?php endif ?> item"> <?php echo get_page_by_path(__('nous-contacter', 'gpdealdomain'))->post_title ?> </a>
            </div>
        </div>
        <!--        <div class="ui three column stackable doubling grid">
                    <div class="column">
                        <div class="ui list">
                            <a href="<?php echo get_permalink(get_page_by_path(__('mentions-legales', 'gpdealdomain'))) ?>" class="item"><i class="info icon"></i><?php echo get_page_by_path(__('mentions-legales', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))) ?>" class="item"><i class="universal access icon"></i><?php echo get_page_by_path(__('conditions-dutilisation', 'gpdealdomain'))->post_title ?></a>
                            <a href="<?php echo get_permalink(get_page_by_path(__('nous-contacter', 'gpdealdomain'))) ?>" class="item"><i class="mail icon"></i><?php echo get_page_by_path(__('nous-contacter', 'gpdealdomain'))->post_title ?></a>
                        </div>
                    </div>
                    <div class="column">
                        <div class="ui list">
                            
                        </div>
                    </div>
                </div>-->
        <div class="ui stackable inverted divided equal height stackable grid center aligned">
            <div class="five wide column center aligned">
                <div class="ui inverted" style="width: 25em"><strong>&copy;2017 - Global Parcel Deal - tous les droits réservés</strong></div>
            </div>
        </div>
    </div>
</div>
</div>
<?php wp_footer() ?>

<?php if (is_page(__('inscription', 'gpdealdomain')) || is_page(__('inscription', 'gpdealdomain') . '/' . __('recapitulatif-du-compte', 'gpdealdomain'))): ?>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
    </script>   
<?php endif ?>

<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsKRohVxC2BavLF5MeV93AKVDkkJaE0mU&libraries=places"></script>
<script>
            var input = document.getElementById('s');
            var options = {
                //bounds: defaultBounds,
                types: ['(cities)']
            };
            autocomplete = new google.maps.places.Autocomplete(input, options);
</script>-->
<?php if (is_home() || is_front_page()): ?>
<!--    <script>
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
    </script>-->
<?php endif ?>
<?php if (is_page(__('mon-compte', 'gpdealdomain') . '/' . __('expeditions', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain')) || is_singular('package') || is_page(__('mon-compte', 'gpdealdomain') . '/' . __('offres-de-transport', 'gpdealdomain') . '/' . __('saisir', 'gpdealdomain')) || is_singular('transport-offer')):
    ?>
<!--    <script>
        var input1 = document.getElementById('start_city');
        var input2 = document.getElementById('destination_city');
        var options = {
            //bounds: defaultBounds,
            types: ['(cities)']
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
        autocomplete2 = new google.maps.places.Autocomplete(input2, options);
    </script>-->
<?php endif ?>
    
<?php if (is_page(__('inscription', 'gpdealdomain')) || is_page(__('inscription', 'gpdealdomain') . '/' . __('recapitulatif-du-compte', 'gpdealdomain')) || is_page(__('mon-compte', 'gpdealdomain') . '/' .__('profil', 'gpdealdomain'))): ?>
<!--       <script>
        var input1 = document.getElementById('locality');
        var input2 = document.getElementById('locality_pro');
        var options = {
            //bounds: defaultBounds,
            types: ['(cities)']
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
        autocomplete2 = new google.maps.places.Autocomplete(input2, options);
    </script>-->
<?php endif ?>
</body>
</html>
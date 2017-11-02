<?php

session_start();
expire_session();
get_header();

include(locate_template('content-single-post.php'));

get_footer();


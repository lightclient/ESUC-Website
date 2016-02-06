<?php
    // set permalinks on heroku
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%year%/%monthnum%/%postname%/' );
    $wp_rewrite->flush_rules();
?>
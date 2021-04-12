<?php

/**
 * Redirect function
 * This function also checks if the input is empty
 */

add_action('template_redirect', 'searchRedirect');
function searchRedirect()
{
    global $wp_rewrite;
    $search_slug = 'vyhladavanie'; // change slug name
    $GLOBALS['wp_rewrite']->search_base = $search_slug;

    if (is_search() && isset($_GET['s'])) {
        $s         = sanitize_text_field($_GET['s']); // or get_query_var( 's' )
        $location  = '/';
        $location .= trailingslashit($wp_rewrite->search_base);
        $location .= (!empty($s)) ? user_trailingslashit(urlencode($s)) : urlencode($s);
        $location  = home_url($location);
        wp_safe_redirect($location, 301);
        $GLOBALS['wp_rewrite']->flush_rules();
        exit;
    }
}

/**
 * Rule without search query
 */

add_filter('search_rewrite_rules', 'searchRewriteRules', 10, 1);
function searchRewriteRules($rewrite)
{
    global $wp_rewrite;
    $search_slug = 'vyhladavanie'; // change slug name
    $GLOBALS['wp_rewrite']->search_base = $search_slug;
    
    $rules = array(
        $wp_rewrite->search_base . '/?$' => 'index.php?s=',
    );
    $rewrite = $rewrite + $rules;
    return $rewrite;
}

flush_rewrite_rules();

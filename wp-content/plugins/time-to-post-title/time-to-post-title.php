<?php
/*
Plugin Name: Time to Post Title
Plugin URI: https://example.com/
Text Domain: time-to-post-title
Description: This plugin adds post time to post info
Version: 1.0
Author: Bohdan Shcherbak
Author URI: https://example.com/
Ліцензія: GPL2
*/

function time_to_post_content($content)
{
    if(is_home()){
        return '<div class="time">' . __('Time of post creation: ', 'time-to-post-title') . get_the_time() . " " . __("Date of post creation:", 'time-to-post-title') . get_the_date() . '</div>' . $content;
    }
    return $content;
    
}
add_filter('the_content', 'time_to_post_content');

function time_load_plugin_textdomain()
{
    load_plugin_textdomain('time-to-post-title', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'time_load_plugin_textdomain');

function time_shortcode($atts, $content = "")
{
    return time_to_post_content($content);
}
add_shortcode('time_to_post', 'time_shortcode');
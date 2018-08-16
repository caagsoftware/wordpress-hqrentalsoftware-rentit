<?php

/*
 * Plugins Assets
 */
function hq_rentit_assets()
{
    wp_register_style( 'hq-rentit-datepicker-css', plugin_dir_url(__FILE__) . 'css/jquery.datetimepicker.min.css');
    wp_register_style('hq-rentit-fontawesome-css', plugin_dir_url( __FILE__  ) . 'css/all.css');
    wp_register_script( 'hq-rentit-datepicker-js', plugin_dir_url(__FILE__) . 'js/jquery.datetimepicker.min.js', array( 'jquery' ), '1.0', true  );
    wp_register_script('moment-js', plugin_dir_url(__FILE__) . 'js/moment.js', array( 'jquery' ), '1.0', true  );
    wp_register_script( 'hq-rentit-app-js', plugin_dir_url(__FILE__) . 'js/hq-rentit.js', array( 'jquery' ), '1.4.3', true );
    wp_enqueue_script('moment-js');
    wp_enqueue_style('hq-rentit-datepicker-css');
    wp_enqueue_style( 'hq-rentit-fontawesome-css');
    wp_enqueue_script('hq-rentit-datepicker-js');
    wp_enqueue_script( 'hq-rentit-app-js' );
}
add_action('wp_enqueue_scripts', 'hq_rentit_assets', 300);

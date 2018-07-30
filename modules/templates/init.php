<?php

/*
 * Overriding Woocommerce Templates
 */

/*
add_filter( 'woocommerce_locate_template', 'woo_addon_plugin_template', 1, 3 );
function woo_addon_plugin_template( $template, $template_name, $template_path ) {
    global $woocommerce;
    $_template = $template;
    if ( ! $template_path )
        $template_path = $woocommerce->template_url;
    $plugin_path  = untrailingslashit(HQ_RENTIT_BASE_DIR . '\modules\templates\woocommerce');
    // Look within passed path within the theme - this is priority
    $template = locate_template(
        array(
            $template_path . $template_name,
            $template_name
        )
    );

    if( ! $template && file_exists( $plugin_path . $template_name ) )
        $template = $plugin_path . $template_name;

    if ( ! $template )
        $template = $_template;

    return $template;
}

*/

function hq_rentit_plugin_path() {
    // gets the absolute path to this plugin directory
    return untrailingslashit( plugin_dir_path( __FILE__ ) );
}
add_filter( 'woocommerce_locate_template', 'hq_rentit_woocommerce_locate_template', 10, 3 );



function hq_rentit_woocommerce_locate_template( $template, $template_name, $template_path ) {
    global $woocommerce;

    $_template = $template;

    if ( ! $template_path ) $template_path = $woocommerce->template_url;

    $plugin_path  = hq_rentit_plugin_path();
    // Look within passed path within the theme - this is priority

    $template = locate_template(

        array(
            $template_path . $template_name,
            $template_name
        )
    );

    // Modification: Get the template from this plugin, if it exists
    if ( ! $template && file_exists( $plugin_path . $template_name ) )
        $template = $plugin_path . $template_name;

    // Use default template
    if ( ! $template )
        $template = $_template;

    // Return what we found
    return $template;
}
<?php



/*
 * Fires on Plugin Activation
 */
function hq_car_integration_install()
{
}
register_activation_hook( __FILE__, 'hq_car_integration_install' );
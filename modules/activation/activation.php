<?php



/*
 * Fires on Plugin Activation
 */
function hq_rentit_integration_install()
{
}
register_activation_hook( __FILE__, 'hq_rentit_integration_install' );
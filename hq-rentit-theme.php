<?php
/**
 * Plugin Name: HQ RentIt Theme Integration
 * Description: HQ Rental Software Theme Integration
 * Version: 0.0.7
 * Author: HQ Rental Software
 * Author URI: http://hqrentalsoftware.com
 * Text Domain: hqrentit
 **/

/*
 * Requiring Files
 */

/*
 *  Shortcode Plugin
 */
require_once(ABSPATH . 'wp-content/plugins/js_composer/js_composer.php');
define('HQ_RENTIT_BASE_FILE', __FILE__);
define('HQ_RENTIT_BASE_DIR', dirname(HQ_RENTIT_BASE_FILE));

/*
 * Others Files
 */
require_once('modules/init.php');
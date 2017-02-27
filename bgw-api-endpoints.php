<?php
namespace BGW\API;

/**
 * Plugin Name: Board Game Weekly API Endpoints
 * Plugin URI: http://jmichaelward.com
 * Description: Custom API Endpoints for the Board Game Weekly website.
 * Author: J. Michael Ward
 * Author URI: https://jmichaelward.com
 */

require_once plugin_dir_path( __FILE__ ) . '/src/API.php';

$plugin = new API();
$plugin->run();

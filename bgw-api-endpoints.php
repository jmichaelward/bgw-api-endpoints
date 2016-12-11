<?php
namespace BGW\Api;

/**
 * Plugin Name: Board Games Weekly API Endpoints
 * Plugin URI: http://boardgamesweek.com
 * Description: Custom API Endpoints for the Board Game weekly
 * Author: J. Michael Ward
 * Author URI: https://jmichaelward.com
 */

require_once plugin_dir_path( __FILE__ ) . '/src/Api.php';

$plugin = new Api();
$plugin->run();


<?php
namespace BGW\API;

use BGW\API\Endpoints\Events;
use BGW\API\Endpoints\Games;

/**
 * Class API
 *
 * @package BGW\API
 */
class API {
	/**
	 * Initialize the API class.
	 */
	public function run() {
		$this->load_dependencies();
		$this->hooks();
	}

	/**
	 * Load class files.
	 */
	private function load_dependencies() {
		require_once dirname( __FILE__ ) . '/Endpoints/Events.php';
		require_once dirname( __FILE__ ) . '/Endpoints/Games.php';
	}

	/**
	 * Register WordPress hooks.
	 */
	public function hooks() {
		add_action( 'rest_api_init', [ new Games, 'register_routes' ] );
		add_action( 'rest_api_init', [ new Events, 'register_routes' ] );
	}
}

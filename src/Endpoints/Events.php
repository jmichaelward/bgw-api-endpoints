<?php
namespace BGW\API\Endpoints;

use BGW\EventBrite\EventBrite;

/**
 * Class Events
 *
 * @package BGW\Api\Endpoints
 */
class Events {
	/**
	 * Register custom API routes for the Event.
	 */
	public function register_routes() {
		$event_brite = new EventBrite();

		register_rest_route( 'bgw/v1', '/events/', [
			'methods'  => 'GET',
			'callback' => [ $event_brite, 'get_events' ],
		] );

		register_rest_route( 'bgw/v1', '/events/next/', [
			'methods'  => 'GET',
			'callback' => [ $event_brite, 'get_next_event' ],
		] );
	}
}

<?php
namespace BGW\API\Endpoints;

/**
 * Class Games
 *
 * @package BGW\API\Endpoints
 */
class Games {
	/**
	 * Register custom API routes for games.
	 *
	 * TODO: Probably instead roll this in with the Games post type.
	 */
	public function register_routes() {
		register_rest_route( 'bgw/v1', '/games/', [
			'methods'  => 'GET',
			'callback' => [ $this, 'get_games' ],
		] );
	}

	/**
	 * Get the complete collection of games.
	 *
	 * @return array|mixed|\WP_Error
	 */
	public function get_games() {
		$titles = get_transient( 'bgw_games_list' );

		if ( ! $titles ) {
			$posts = get_posts( [ // @codingStandardsIgnoreLine
				'orderby'        => 'title',
				'order'          => 'ASC',
				'post_type'      => 'bgw_game',
				'posts_per_page' => -1, // @codingStandardsIgnoreLine - for now.
			] );

			if ( empty( $posts ) ) {
				return new \WP_Error(
					'no_games_found',
					'No Games!',
					[
						'status' => 404,
					]
				);
			}

			$titles = [];

			foreach ( $posts as $post ) {
				$meta  = get_post_meta( $post->ID, 'bgw_game_meta', true );
				$title = [
					'name'       => get_the_title( $post->ID ),
					'image'      => get_the_post_thumbnail_url( $post->ID, 'medium' ),
					'minPlayers' => $meta->minPlayers, // @codingStandardsIgnoreLine - third-party object.
					'maxPlayers' => $meta->maxPlayers, // @codingStandardsIgnoreLine - third-party object.
				];

				$titles[] = $title;
			}

			set_transient( 'bgw_games_list', $titles, 1 * MINUTE_IN_SECONDS );
		}

		return $titles;
	}
}

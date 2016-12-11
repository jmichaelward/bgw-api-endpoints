<?php
namespace BGW\Api;

/**
 * Class Api
 * @package BGW\API
 */
class Api {
    /**
     *
     */
    public function run() {
        $this->hooks();
    }

    /**
     *
     */
    public function hooks() {
        add_action( 'rest_api_init', [ $this, 'register_games_route' ] );
    }

    /**
     *
     */
    public function register_games_route() {
        register_rest_route( 'bgw/v1', '/games/', [
            'methods' => 'GET',
            'callback' => [ $this, 'get_games' ],
            'args' => [
                'id' => [
                    'validate_callback' => function( $param, $request, $key ) {
                        return is_numeric( $param );
                    }
                ]
            ],
        ] );
    }

    /**
     * @return array|\WP_Error
     */
    public function get_games() {
        $posts = get_posts( [
            'orderby'        => 'title',
            'order'          => 'ASC',
            'post_type'      => 'bgw_game',
            'posts_per_page' => - 1,
        ]);

        if ( empty( $posts ) ) {
            return new \WP_Error( 'no_games_found', 'No Games!', [ 'status' => 404 ] );
        }

        $titles = [];

        foreach ( $posts as $post ) {
            $titles[] = $post->post_title;
        }

        return $titles;
    }
}



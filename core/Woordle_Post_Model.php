<?php
/**
 * @package Woordle/Core
 */

class Woordle_Post_Model
{
	/**
	 * @var string
	 */
	public $post_type_name;

	/**
	 * @var string
	 */
	public $singular_name;

	/**
	 * @var string
	 */
	public $plural_name;

	/**
	 * @var bool
	 */
	public $public;

	/**
	 * @var bool
	 */
	public $publicly_queryable = true;

	/**
	 * @var bool
	 */
	public $show_ui = true;

	/**
	 * @var bool
	 */
	public $show_in_menu =  true;

	/**
	 * @var bool
	 */
	public $query_var = true;

	/**
	 * @var array
	 */
	public $rewrite;

	/**
	 * @var string
	 */
	public $capability_type = 'post';

	/**
	 * @var bool
	 */
	public $has_archive = true;

	/**
	 * @var bool
	 */
	public $hierarchical = false;

	/**
	 * @var int|null
	 */
	public $menu_position = null;

	/**
	 * @var array
	 */
	public $supports = [ 'title', 'thumbnail', 'comments', 'editor' ];

	/**
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * @var array
	 */
	private $labels = [];

	public function __construct( $post = 0 ) {
		$this->set_model_names();
		$this->set_model_labels();
		$this->set_attributes( $post );
	}

	/**
	 * @param $name
	 *
	 * @return mixed
	 */
	public function __get( $name ) {
		return $this->attributes[$name];
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function __set( $name, $value ) {
		$this->attributes[$name] = $value;
	}

	private function set_model_names() {

		if ( is_null( $this->post_type_name ) ) {
			$this->post_type_name = strtolower( get_class( $this ) );
		}

		if ( is_null( $this->singular_name ) ) {
			$this->singular_name = ucfirst( $this->post_type_name );
		}

		if ( is_null( $this->plural_name ) ) {
			$this->plural_name = ucfirst( $this->post_type_name ) . 's';
		}

		if ( is_null( $this->rewrite ) ) {
			$this->rewrite = [ 'slug' => $this->post_type_name ];
		}
	}

	private function set_model_labels() {
		$this->labels = [
			'name'               => _x( $this->plural_name, 'post type general name', 'woordle' ),
			'singular_name'      => _x( $this->singular_name, 'post type singular name', 'woordle' ),
			'menu_name'          => _x( $this->plural_name, 'admin menu', 'woordle' ),
			'name_admin_bar'     => _x( $this->singular_name, 'add new on admin bar', 'woordle' ),
			'add_new'            => _x( 'Add New', 'book', 'woordle' ),
			'add_new_item'       => __( 'Add New ' . $this->singular_name, 'woordle' ),
			'new_item'           => __( 'New ' . $this->singular_name, 'woordle' ),
			'edit_item'          => __( 'Edit ' . $this->singular_name, 'woordle' ),
			'view_item'          => __( 'View ' . $this->singular_name, 'woordle' ),
			'all_items'          => __( 'All ' . $this->plural_name, 'woordle' ),
			'search_items'       => __( 'Search ' . $this->plural_name, 'woordle' ),
			'parent_item_colon'  => __( 'Parent ' . $this->singular_name . ':', 'woordle' ),
			'not_found'          => __( 'No ' . strtolower( $this->plural_name ) . ' found.', 'woordle' ),
			'not_found_in_trash' => __( 'No ' . strtolower( $this->plural_name ) . ' found in Trash.', 'woordle' )
		];
	}

	public function register_model_post_type() {

		register_post_type( $this->post_type_name, [
			'labels' => $this->labels,
			'description'        => __( 'Description.', 'woordle' ),
			'public'             => $this->public,
			'publicly_queryable' => $this->publicly_queryable,
			'show_ui'            => $this->show_ui,
			'show_in_menu'       => $this->show_in_menu,
			'query_var'          => $this->query_var,
			'rewrite'            => $this->rewrite,
			'capability_type'    => $this->capability_type,
			'has_archive'        => $this->has_archive,
			'hierarchical'       => $this->hierarchical,
			'menu_position'      => $this->menu_position,
			'supports'           => $this->supports
		]);
	}

	private function set_attributes( $post ) {
		$this->attributes = [];
		if ( $post !== 0) {
			$_post = get_post( [ 'ID' => $post, 'post_type' => $this->post_type_name ] );
			$_meta_fields = get_fields( $post );
			if ( !is_null( $_post ) ) {
				foreach ( get_object_vars( $_post ) as $key => $value ) {
					$this->$key = $value;
				}
			}

			if ( $_meta_fields ) {
				foreach ( $_meta_fields as $key => $value ) {
					$this->$key = $value;
				}
			}
		}
	}

	public function group() {

	}

	public function find( $id ) {

		$_post = get_post( $id );

		if ( is_null( $_post ) ) {
			return null;
		}
		$this->set_attributes( $id );
		return $this;
	}

	public function get() {
		$_posts = [];
		$args = [
			'post_type' => $this->post_type_name
		];

		$_get_posts = get_posts( $args );

		if ( count( $_get_posts ) > 0 ) {

			foreach ( $_get_posts as $post ) {
				$_post = $this;
				$_meta_fields = get_fields( $post );

				foreach ( get_object_vars( $post ) as $key => $value ) {
					$_post->$key = $value;
				}

				if ( $_meta_fields ) {
					foreach ( $_meta_fields as $key => $value ) {
						$_post->$key = $value;
					}
				}

			}
		}

		return $_posts;
	}
}
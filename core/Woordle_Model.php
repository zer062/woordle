<?php
/**
 * @package Woordle/Core
 */

class Woordle_Model
{
	/**
	 * @var string
	 */
	protected $post_type_name;

	/**
	 * @var array
	 */
	protected $attributes = [];

	public function __construct() {
		$this->register_post_type_name();
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

	private function register_post_type_name() {

		var_dump($this->post_type_name); die;
	}

	private function register_post() {

//		if ( !post_type_exists( $this->))
	}

	public static function find( $id ) {
		$_post = get_post( $id );

		if ( is_null( $_post ) ) {
			return null;
		}

		$_attributes = get_post_meta( $id );

		$_the_post = self::class;


	}
}
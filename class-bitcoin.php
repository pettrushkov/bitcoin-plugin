<?php
/**
 * File, which contains class Bitcoin
 *
 * @package Bitcoin
 * @author pettrushkov
 * @version 1.0
 */

/**
 * This file defines the Bitcoin class, which provides functionality related to Bitcoin.
 */
class Bitcoin {

	/**
	 * Tag of shortcode.
	 *
	 * @var string
	 */
	public $shortcode_tag = 'btc_price';

	/**
	 * Method to run add hooks
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'init', array( $this, 'register_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front' ) );
	}

	/**
	 * Register shortcode
	 *
	 * @return void
	 */
	public function register_shortcode() {
		add_shortcode( $this->shortcode_tag, array( $this, 'shortcode_content' ) );
	}

	/**
	 * Content of registered shortcode
	 */
	public function shortcode_content() {
		$file_path = plugin_dir_path( __FILE__ ) . 'template.php';

		ob_start();
		// Include template.
		include $file_path;
		$output = ob_get_clean();

		return $output;
	}

	/**
	 * Add styles and scripts for frontend
	 *
	 * @return void
	 */
	public function enqueue_front() {
		global $post;
		if ( has_shortcode( $post->post_content, 'btc_price' ) ) {
			wp_enqueue_style( 'bitcoin-style', plugin_dir_url( __FILE__ ) . 'front/styles.css', array(), '1.0' );
			wp_enqueue_script( 'bitcoin-script', plugin_dir_url( __FILE__ ) . 'front/scripts.js', array(), '1.0', true );
		}
	}
}

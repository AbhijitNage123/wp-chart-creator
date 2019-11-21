<?php
/**
 * Responsible for setting up constants, classes and includes.
 *
 * @author Abhijit Nage
 * @package WP Chart Creater/Loader
 */

if ( ! class_exists( 'WCC_Loader' ) ) {
	/**
	 * Responsible for setting up constants, classes and includes.
	 *
	 * @since 1.0
	 */
	final class WCC_Loader {
	/**
	 * The unique instance of the plugin.
	 *
	 * @var Instance variable
	 */
	private static $instance;

	/**
	 * Gets an instance of our plugin.
	 */
	/**
	 * Gets an instance of our plugin.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->define_constants();
		$this->load_files();
		add_action( 'admin_menu', array( $this, 'wcc_add_plugin_page' ) );
	}
	/**
	 * Define constants.
	 *
	 * @since 1.0
	 * @return void
	 */
	private function define_constants() {
		$file = dirname( dirname( __FILE__ ) );
		define( 'WCC_VERSION', '1.0.0' );
		define( 'WCC_BASE_DIR_NAME', plugin_basename( $file ) );
		define( 'WCC_BASE_FILE', trailingslashit( $file ) . WCC_BASE_DIR_NAME . '.php' );
		define( 'WCC_BASE_DIR', plugin_dir_path( WCC_BASE_FILE ) );
		define( 'WCC_BASE_URL', plugins_url( '/', WCC_BASE_FILE ) );
	}
	/**
	 * Loads classes and includes.
	 *
	 * @since 1.0
	 * @return void
	 */
	private static function load_files() {
		require_once WCC_BASE_DIR . 'includes/class-wcc-main.php';
		// require_once WCC_BASE_DIR . 'includes/class-wcc-settings.php';
	}
	/**
	 * WP Chart Creator Option in Setting Page.
	 */
	public function wcc_add_plugin_page() {
		// This page will be under "Settings".
		add_options_page(
			'Settings Admin',
			'WP Chart Creator',
			'manage_options',
			'wcc-setting-admin-page',
			array( $this, 'wcc_create_admin_page' )
		);
	}
	/**
	 * Creating Admin Page.
	 */
	public function wcc_create_admin_page() {
			require_once WCC_BASE_DIR . 'includes/class-wcc-frontend.php';
	}

	}
	$wcc_loader = WCC_Loader::get_instance();
}
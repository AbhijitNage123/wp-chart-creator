<?php
/**
 * WP Chart Creator plugin for WordPress
 *
 * @package   wp-chart-creater
 * @author    Abhijit Nage <nageabhijit@gmail.com>
 * @copyright 2019 Abhijit Nage
 * @license   GPL v2 or later
 *
 * Plugin Name:  WP Chart Creator
 * Description:  Chart Creater  for WordPress.
 * Version:      1.0.0
 * Plugin URI:   nageabhijit@gmail.com
 * Author:       Abhijit Nage
 * Author URI:   nageabhijit@gmail.com
 * Text Domain:  wp-chart-creater
 * Requires PHP: 5.3+
*/

 defined( 'ABSPATH' ) || die();

 $wcc_dir = dirname( __FILE__ );

 require_once "{$wcc_dir}/classes/wcc-loader.php";
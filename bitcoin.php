<?php
/**
 * Bitcoin shortcode plugin
 *
 * @package Bitcoin_Price
 * Plugin Name: Bitcoin Price
 * Description: Add shortcode to fetch bitcoin rate. Shortcode [btc_price]
 * Version: 1.0
 * Author: pettrushkov
 * Author URI: https://denys.pp.ua/
 * License: GPLv2 or later
 * Text Domain: bitcoin
 */

// require Bitcoin class.
require 'class-bitcoin.php';

$bitcoin = new Bitcoin();
$bitcoin->init();

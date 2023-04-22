<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/friends-of-wp-hosting/WPSecurityScore
 * @since             0.0.1
 * @package           WPSecurityScore
 *
 * @wordpress-plugin
 * Plugin Name:       ##PLUGIN_NAME##
 * Plugin URI:        https://github.com/friends-of-wp-hosting/WPSecurityScore
 * Description:       ##PLUGIN_DESCRIPTION##
 * Version:           ##PLUGIN_VERSION##
 * Author:            Friends of WP hosting
 * Author URI:        https://github.com/friends-of-wp-hosting
 * License:           MIT
 * License URI:       https://opensource.org/license/mit/
 * Text Domain:       WPSecurityScore
 * Domain Path:       /languages
 */

if (!defined('WPINC')) die;

include_once ABSPATH . 'wp-admin/includes/plugin.php';
include_once ABSPATH . 'wp-admin/includes/admin.php';

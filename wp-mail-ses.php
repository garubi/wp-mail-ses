<?php
/**
 * WP Mail SES
 *
 * Uses Amazon Web Services (AWS) Simple Email Service (SES) to send emails.
 * Based on the original WP SES project by Sylvain Deaure. Main differences:
 * - Does not store credentials in the database
 * - Convention over configuration
 * - Removed any functionality which can be done via AWS Console
 * - Open Source and version controlled via GitHub
 *
 * @package     wp-mail-ses
 * @author      Bashkim Isai
 * @copyright   2016-2018 Bashkim Isai
 * @license     MIT
 *
 * @wordpress-plugin
 * Plugin Name: WP Mail SES
 * Plugin URI:  https://github.com/bashaus/wp-mail-ses
 * Version:     0.0.4
 * Description: Uses Amazon's Simple Email Service (SES) to send emails
 * Author:      Bashkim Isai
 * Author URI:  https://www.bashkim.com/
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: wp-mail-ses
 * Domain Path: /languages
 */

require_once __DIR__ . '/lib/php-aws-ses/SimpleEmailService.php';
require_once __DIR__ . '/lib/php-aws-ses/SimpleEmailServiceMessage.php';
require_once __DIR__ . '/lib/php-aws-ses/SimpleEmailServiceRequest.php';
require_once __DIR__ . '/models/class-wp-mail-ses.php';
require_once __DIR__ . '/functions.php';

WP_Mail_SES::get_instance();

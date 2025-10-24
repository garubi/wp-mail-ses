<?php
/**
 * WP Mail SES
 *
 * Uses Amazon Web Services (AWS) Simple Email Service (SES) to send emails.
 *
 * @package     wp-mail-ses
 * @author      Bashkim Isai, Stefano Garuti
 * @copyright   2016-2018 Bashkim Isai, 2020 - 2021 Stefano Garuti
 * @license     MIT
 *
 * @wordpress-plugin
 * Plugin Name: WP Mail SES
 * Plugin URI:  https://github.com/garubi/wp-mail-ses
 * Version:     2.0
 * Description: Uses Amazon's Simple Email Service (SES) to send emails.
 * Author:      Bashkim Isai, Stefano Garuti
 * Author URI:  https://github.com/garubi/
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

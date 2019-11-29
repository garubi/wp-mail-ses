=== WP Mail SES ===
Contributors: bashaus
Tags: wp_mail, ses, mail
Requires at least: 3.0.1
Tested up to: 4.9.1
Stable tag: trunk
License: MIT
License URI: https://opensource.org/licenses/MIT

Uses Amazon Web Services (AWS) Simple Email Service (SES) to send emails in WordPress.

== Description ==

Uses Amazon Web Services (AWS) Simple Email Service (SES) to send emails.
Based on the original WP SES project by Sylvain Deaure. Main differences:

* Does not store credentials in the database
* Convention over configuration
* Removed any functionality which can be done via AWS Console
* Open Source and [version controlled via GitHub](https://github.com/bashaus/wp-mail-ses/)

== Installation ==

Follow these instructions:

= 1. Amazon confirmation and approval =

You will need to setup Simple Email Service (SES) on your Amazon Web Services
account before you can use this plugin.

For more information, [read Amazon's documentation on how to setup
SES](https://docs.aws.amazon.com/ses/latest/DeveloperGuide/setting-up-email.html)

= 2. Update configuration =

Update your `wp-config.php` file to include the required constants:

    /**
     * Include your AWS keys.
     *
     * A safe approach is to store your key and secret in environment
     * variables. This way, your credentials are not hard coded in version
     * control.
     */

    define( 'WP_MAIL_SES_ACCESS_KEY_ID', getenv( 'WP_MAIL_SES_ACCESS_KEY_ID' ) );
    define( 'WP_MAIL_SES_SECRET_ACCESS_KEY', getenv( 'WP_MAIL_SES_SECRET_ACCESS_KEY' ) );

    /**
     * Define the endpoint for your emails to be sent. Endpoints include:
     *
     * email.us-east-1.amazonaws.com
     * email.us-west-2.amazonaws.com
     * email.eu-west-1.amazonaws.com
     */

    define( 'WP_MAIL_SES_ENDPOINT', 'email.eu-west-1.amazonaws.com' );

Optional extra configuration:

    /**
     * Define the composer information for your email (who the email is
     * sent from). The email address must be approved in your AWS console
     * in the specified region.
     *
     * This email address is used if a composer is not already defined by
     * the email.
     */

    define( 'WP_MAIL_SES_COMPOSER_NAME', 'Company Name' );
    define( 'WP_MAIL_SES_COMPOSER_EMAIL', 'confirmed@example.com' );

    /**
     * Disable accessing of statistics from the Dashboard.
     * This can help if you're hitting the API too frequently.
     */

    define( 'WP_MAIL_SES_HIDE_STATISTICS', true );


= 3. Install plugin =

Copy this folder `wp-mail-ses` to your `/wp-content/plugins/` directory.


= 4. Activate plugin =

Go to your WordPress Administration and activate the `WP Mail SES` plugin.

= 5. Send a test message =

Go to: `Admin` &raquo; `Settings` &raquo; `WP Mail SES`

== Upgrade Notice ==

No notices


== Changelog ==

= 0.0.4 =
* Integrated with Travis CI
* Added PHPCS and linked to WordPress-Extra standards
* Cleaned up code with phpcs/phpcbf
* Added .editorconfig
* Updated SimpleEmailService to 0.9.0

= 0.0.3 =
* Bug fix for $recipients variable [#3]

= 0.0.2 =
* Added filter to notify of email sent status [#2]

= 0.0.1 =
* Initial release


== Frequently Asked Questions ==

= Why isn't my email sending? =

There are a number of reasons that an email might not be sent via SES, here is
a quick checklist to ensure that the plugin has been setup properly:

Have you:

* Defined `WP_MAIL_SES_ACCESS_KEY_ID`, `WP_MAIL_SES_SECRET_ACCESS_KEY` and
  `WP_MAIL_SES_ENDPOINT` in `wp-config.php`?
* Confirmed that you own a domain name in the Amazon SES console?
* Confirmed an email address in the Amazon SES console?
* Requested your [service limit to be increased](https://docs.aws.amazon.com/ses/latest/DeveloperGuide/request-production-access.html) ?
* Tried defining `WP_MAIL_SES_COMPOSER_EMAIL` in `wp-config.php` with your
  verified email address?

= I can send emails to myself, but not to others =

In order to send emails to the public, you need to move out of the Amazon SES
Sandbox and into the production account. [Read the documentation on
Amazon](https://docs.aws.amazon.com/ses/latest/DeveloperGuide/request-production-access.html).

= Got another question? =

You can [post your question on GitHub](https://github.com/bashaus/wp-mail-ses).

== Screenshots ==

None yet

== Usage ==

= View statistics =

Go to: `Admin` &raquo; `Dashboard` &raquo; `SES Statistics`

= Send test message =

Go to: `Admin` &raquo; `Settings` &raquo; `WP Mail SES`

= Hooks/Filters =

`wp_mail_ses_sent_email` - This function is called once an email has been sent
to SES and provides two parameters:

* `$message_id` (`string` or `null`) -
  The `MessageId` as provided by SES if the request was successful,
  otherwise null.
* `$mail_data` (`array`) -
  A hash map containing the information used to send the email. Keys include:
  `to`, `subject`, `message`, `headers`, `attachments`

Example:

    add_filter( 'wp_mail_ses_sent_email', function ( $message_id, $mail_data ) {
        if ( is_null( $message_id ) ) {
            echo "Sending failed";
        } else {
            echo "Sending successful";
        }

        print_r( $mail_data );
    } );

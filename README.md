# WP Mail SES

Uses Amazon Web Services (AWS) Simple Email Service (SES) to send emails.
Based on the original WP SES project by Sylvain Deaure. Main differences:
 
* Does not store credentials in the database
* Convention over configuration
* Removed any functionality which can be done via AWS Console
* Open Source and public version control


## Installation

Follow these instructions:


### Amazon confirmation and approval

Go to the [Amazon Web Services Console](http://console.aws.amazon.com/)
and confirm your email address or domain.

You will also need to request your service limits to be increased once you're
ready to go live.

### Install plugin

Copy this folder `wp-mail-ses` to your `/wp-content/plugins/` directory.


### Update configuration

Update your `wp-config.php` file to include the required constants:

```
/**
 * Include your AWS keys below. A good idea is to make sure these are
 * not hard coded, but resourced in from environmental variables. This
 * way it is not hard coded in to your version control.
 */

define('WP_MAIL_SES_ACCESS_KEY_ID', 'loremipsumdolarsitamet');
define('WP_MAIL_SES_SECRET_ACCESS_KEY', 'loremipsumdolarsitamet');

/**
 * Define the endpoint for your emails to be sent. Endpoints include:
 *
 * email.us-east-1.amazonaws.com
 * email.us-west-2.amazonaws.com
 * email.eu-west-1.amazonaws.com
 */

define('WP_MAIL_SES_ENDPOINT', 'email.eu-west-1.amazonaws.com');
```

Optional extra configuration:

```
/**
 * Define the composer information for your email (who the email is 
 * sent from). The email address must be approved in your AWS console
 * in the specified region.
 */

define('WP_MAIL_SES_COMPOSER_NAME', 'Company Name');
define('WP_MAIL_SES_COMPOSER_EMAIL', 'confirmed@mail.com');

/**
 * Disable accessing of statistics from the Dashboard
 */

define('WP_MAIL_SES_HIDE_STATISTICS', true);
```


### Activate plugin

Go to your WordPress Administration and activate the `WP Mail SES` plugin.



## Usage

### View statistics

Go to: `Admin` &raquo; `Dashboard` &raquo; `SES Statistics`

### Send test message

Go to: `Admin` &raquo; `Settings` &raquo; `WP Mail SES`

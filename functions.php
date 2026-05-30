<?php

add_filter( 'pre_wp_mail', 'wp_mail_ses', 10, 2 );

/**
 * Short-circuits wp_mail() and routes message delivery through Amazon SES.
 *
 * Hooked to `pre_wp_mail` (WordPress 5.7+).
 * Returning a non-null value bypasses WordPress default mailer flow.
 *
 * @param null|bool $pre_wp_mail Existing short-circuit value from previous filters.
 * @param array     $atts        Normalized wp_mail() arguments.
 * @return bool|null Returns previous short-circuit value, or SES send result.
 */
function wp_mail_ses( $pre_wp_mail, $atts ) {
	if ( null !== $pre_wp_mail ) {
		return $pre_wp_mail;
	}

	$to          = isset( $atts['to'] ) ? $atts['to'] : '';
	$subject     = isset( $atts['subject'] ) ? $atts['subject'] : '';
	$message     = isset( $atts['message'] ) ? $atts['message'] : '';
	$headers     = isset( $atts['headers'] ) ? $atts['headers'] : '';
	$attachments = isset( $atts['attachments'] ) ? $atts['attachments'] : '';

	return (bool) WP_Mail_SES::get_instance()->send_email(
		$to,
		$subject,
		$message,
		$headers,
		$attachments
	);
}

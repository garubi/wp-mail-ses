<?php

if ( function_exists( 'wp_mail' ) ) {
	add_action(
		'admin_notices',
		array( WP_Mail_SES::get_instance(), 'warning_wp_mail_exists' )
	);
} else {
	function wp_mail( $to, $subject, $message, $headers = '', $attachments = '' ) {
		return WP_Mail_SES::get_instance()->send_email(
			$to,
			$subject,
			$message,
			$headers,
			$attachments
		);
	}
}

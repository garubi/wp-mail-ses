<?php

if (!function_exists('wp_mail')) {
    function wp_mail($to, $subject, $message, $headers = '', $attachments = '') {
        $id = WP_Mail_SES::get_instance()->send_email(
            $to,
            $subject,
            $message,
            $headers,
            $attachments
        );
		
		$mail_data = array(
			'ses_message_id'	=> $id,
			'to' 				=> $to,
			'subject'			=> $subject,
            'message'			=> $message,
            'headers'			=> $headers,
            'attachments'		=> $attachments
		);
		
		$wp_mail_standard_response = !empty($id);
		
		/**
		 * Filter the SES response on email sent.
		 *
		 * Use this filter to intercept (and maybe change) the SES message ID before the plugin set it to just 0 (on failure) or 1 (on email sent ok) .
		 *
		 * @param bool $wp_mail_standard_response The response in the format that wp_mail() expect it. I.e. 0 or 1.
		 *
		 * @param array mail_data An Array with all the data of the email sent and the SES message id returned. The array's key are: 'ses_message_id', 'to', 'subject', 'message', 'headers', 'attachments'
		 */
		return apply_filters( 'wp_mail_ses_sent_email', $wp_mail_standard_response, $mail_data);
    }
}

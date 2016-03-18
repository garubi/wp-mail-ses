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

        return !empty($id);
    }
}

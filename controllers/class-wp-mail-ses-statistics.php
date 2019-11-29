<?php

class WP_Mail_SES_Statistics {

	protected static $instance;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new self();
		}

		return static::$instance;
	}

	public function handle() {
		return $this->index();
	}

	public function index() {
		$wp_mail_ses = WP_Mail_SES::get_instance();

		if ( ! $wp_mail_ses->is_statistics_enabled() ) {
			throw new Exception( 'Access denied' );
		}

		/* Send Quota */

		try {
			$quota = $wp_mail_ses->ses->getSendQuota();

			if ( ! $quota ) {
				throw new Exception( 'Could not get quota statistics' );
			}

			$quota['SendRemaining'] = $quota['Max24HourSend'] - $quota['SentLast24Hours'];

			if ( $quota['Max24HourSend'] > 0 ) {
				$quota['SendUsage'] = sprintf( '%0.3f', $quota['SentLast24Hours'] / $quota['Max24HourSend'] * 100 );
			} else {
				$quota['SendUsage'] = 0;
			}
		} catch ( Exception $e ) {
			$quota = null;
		}

		/* Send Statistics */
		try {
			$stats = $wp_mail_ses->ses->getSendStatistics();

			if ( ! $stats ) {
				throw new Exception( 'Could not get send statistics' );
			}

			usort( $stats['SendDataPoints'], array( $this, 'sort_timestamp' ) );
		} catch ( Exception $e ) {
			$stats = null;
		}

		include __DIR__ . '/../views/statistics/index.php';
	}

	public function sort_timestamp( $a, $b ) {
		return ( $a['Timestamp'] < $b['Timestamp'] ) ? -1 : 1;
	}
}

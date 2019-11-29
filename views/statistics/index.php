<div class="wrap">
	<h2><?php esc_html_e( 'Amazon SES Stats', 'wp-mail-ses' ); ?></h2>

	<?php if ( ! $quota ) : ?>
		<div class="error">
			<p><?php esc_html_e( 'Could not get quota information from SES', 'wp-mail-ses' ); ?></p>
		</div>
	<?php endif ?>

	<?php if ( ! $stats ) : ?>
		<div class="error">
			<p><?php esc_html_e( 'Could not get sending statistics from SES', 'wp-mail-ses' ); ?></p>
		</div>
	<?php endif ?>

	<?php if ( $quota ) : ?>
		<h3><?php esc_html_e( 'Quotas', 'wp-mail-ses' ); ?></h3>

		<table class="form-table">
			<tr>
				<th rowspan="2"><?php esc_html_e( 'Throughput allowed', 'wp-mail-ses' ); ?></th>
				<td>
					<?php echo esc_html( $quota['MaxSendRate'] ); ?>
					<?php esc_html_e( 'emails per second', 'wp-mail-ses' ); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo esc_html( $quota['Max24HourSend'] ); ?>
					<?php esc_html_e( 'emails per 24 hour period', 'wp-mail-ses' ); ?>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Emails sent', 'wp-mail-ses' ); ?></th>
				<td>
					<?php echo esc_html( $quota['SentLast24Hours'] ); ?>
					(<?php echo esc_html( $quota['SendUsage'] ); ?>%)
					<?php esc_html_e( 'sent in this 24 hour period', 'wp-mail-ses' ); ?>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Emails remaining', 'wp-mail-ses' ); ?></th>
				<td>
					<?php echo esc_html( $quota['SendRemaining'] ); ?>
					<?php esc_html_e( 'available in this 24 hour period', 'wp-mail-ses' ); ?>
				</td>
			</tr>
		</table>
	<?php endif ?>

	<?php if ( $stats ) : ?>
		<h3><?php esc_html_e( 'Sending Statistics', 'wp-mail-ses' ); ?></h3>
		<p><?php esc_html_e( 'Last 15 days of email statistics.', 'wp-mail-ses' ); ?></p>

		<?php if ( empty( $stats['SendDataPoints'] ) ) : ?>
			<div class="updated">
				<p><?php esc_html_e( 'No information is currently available for the past 15 days', 'wp-mail-ses' ); ?></p>
			</div>
		<?php endif ?>

		<?php if ( ! empty( $stats['SendDataPoints'] ) ) : ?>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<td><?php esc_html_e( 'Timestamp', 'wp-mail-ses' ); ?></td>
						<td><?php esc_html_e( 'Delivery Attempts', 'wp-mail-ses' ); ?></td>
						<td><?php esc_html_e( 'Bounces', 'wp-mail-ses' ); ?></td>
						<td><?php esc_html_e( 'Complaints', 'wp-mail-ses' ); ?></td>
						<td><?php esc_html_e( 'Rejects', 'wp-mail-ses' ); ?></td>
						<td><?php esc_html_e( 'Total Ok', 'wp-mail-ses' ); ?></td>
						<td><?php esc_html_e( 'Total Errors', 'wp-mail-ses' ); ?></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $stats['SendDataPoints'] as $point ) : ?>
						<tr>
							<td><?php echo esc_html( $point['Timestamp'] ); ?></td>
							<td><?php echo esc_html( $point['DeliveryAttempts'] ); ?></td>
							<td><?php echo esc_html( $point['Bounces'] ); ?></td>
							<td><?php echo esc_html( $point['Complaints'] ); ?></td>
							<td><?php echo esc_html( $point['Rejects'] ); ?></td>
							<td><?php echo esc_html( $point['DeliveryAttempts'] - $point['Bounces'] - $point['Complaints'] - $point['Rejects'] ); ?></td>
							<td><?php echo esc_html( $point['Bounces'] + $point['Complaints'] + $point['Rejects'] ); ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>

			<ul>
				<li><?php esc_html_e( 'Each row represents a 15 minutes period of sending activity.', 'wp-mail-ses' ); ?></li>
				<li><?php esc_html_e( 'Periods without any activity are not shown.', 'wp-mail-ses' ); ?></li>
			</ul>
		<?php endif ?>
	<?php endif ?>
</div>

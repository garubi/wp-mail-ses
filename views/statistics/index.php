<div class="wrap">
    <h2><?php _e( 'Amazon SES Stats', 'wp-mail-ses' ) ?></h2>

	<div class="welcome-panel">
		<h3><?php _e( 'Quotas', 'wp-mail-ses' ) ?></h3>

		<table class="form-table">
			<tr>
				<th rowspan="2"><?php _e( 'Throughput allowed', 'wp-mail-ses' ) ?></th>
				<td>
					<?php echo $quota['MaxSendRate'] ?>
					<?php _e( 'emails per second', 'wp-mail-ses' ) ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $quota['Max24HourSend'] ?>
					<?php _e( 'emails per 24 hour period', 'wp-mail-ses' ) ?>
				</td>
			</tr>
			<tr>
				<th><?php _e( 'Emails sent', 'wp-mail-ses' ) ?></th>
				<td>
					<?php echo $quota['SentLast24Hours'] ?>
					(<?php echo $quota['SendUsage'] ?>%)
					<?php _e( 'sent in this 24 hour period' ) ?>
				</td>
			</tr>
			<tr>
				<th><?php _e( 'Emails remaining', 'wp-mail-ses' ) ?></th>
				<td>
					<?php echo $quota['SendRemaining'] ?>
					<?php _e( 'available in this 24 hour period' ) ?>
				</td>
			</tr>
		</table>
	</div>

	<h3><?php _e( 'Sending Statistics', 'wp-mail-ses' ) ?></h3>
	<p><?php _e( 'Last 15 days of email statistics.', 'wp-mail-ses' ) ?></p>

	<?php if ( empty( $stats['SendDataPoints'] ) ) : ?>
		<div class="updated">
			<p><?php _e( 'No information is currently available for the past 15 days', 'wp-mail-ses' ) ?></p>
		</div>
	<?php endif ?>

	<?php if ( ! empty( $stats['SendDataPoints'] ) ) : ?>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<td><?php _e( 'Timestamp', 'wp-mail-ses' ) ?></td>
					<td><?php _e( 'Delivery Attempts', 'wp-mail-ses' ) ?></td>
					<td><?php _e( 'Bounces', 'wp-mail-ses' ) ?></td>
					<td><?php _e( 'Complaints', 'wp-mail-ses' ) ?></td>
					<td><?php _e( 'Rejects', 'wp-mail-ses' ) ?></td>
					<td><?php _e( 'Total Ok', 'wp-mail-ses' ) ?></td>
					<td><?php _e( 'Total Errors', 'wp-mail-ses' ) ?></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $stats['SendDataPoints'] as $point ) : ?>
					<tr>
						<td><?php echo $point['Timestamp']; ?></td>
						<td><?php echo $point['DeliveryAttempts']; ?></td>
						<td><?php echo $point['Bounces']; ?></td>
						<td><?php echo $point['Complaints']; ?></td>
						<td><?php echo $point['Rejects']; ?></td>
						<td><?php echo $point['DeliveryAttempts'] - $point['Bounces'] - $point['Complaints'] - $point['Rejects']; ?></td>
						<td><?php echo $point['Bounces'] + $point['Complaints'] + $point['Rejects']; ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>

		<ul>
			<li><?php _e( 'Each row represents a 15 minutes period of sending activity.', 'wp-mail-ses' ); ?></li>
			<li><?php _e( 'Periods without any activity are not shown.', 'wp-mail-ses' ) ?></li>
		</ul>
	<?php endif ?>
</div>

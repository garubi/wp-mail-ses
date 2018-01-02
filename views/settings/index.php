<div class="wrap">
	<h2><?php esc_html_e( 'WP Mail SES Settings', 'wp-mail-ses' ); ?></h2>

	<h3><?php esc_html_e( 'Send Test Email', 'wp-mail-ses' ); ?></h3>
	<p>
		<?php
		esc_html_e(
			'N.B.: Amazon must first activate your account into production mode before you can test this with a non-confirmed email address.',
			'wp-mail-ses'
		)
		?>
	</p>

	<form method="post" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>">
		<?php wp_nonce_field( 'wp-mail-ses' ); ?>

		<table class="form-table">
			<tr>
				<th scope="row"><?php esc_html_e( 'Recipient Email', 'wp-mail-ses' ); ?></th>
				<td><input type="text" name="test_message[to]" size="50" /></td>
			</tr>
			<tr>
				<th scope="row"><?php esc_html_e( 'Subject', 'wp-mail-ses' ); ?></th>
				<td><input type="text" name="test_message[subject]" size="50" /></td>
			</tr>
			<tr>
				<th scope="row"><?php esc_html_e( 'Message (HTML)', 'wp-mail-ses' ); ?></th>
				<td>
					<textarea cols="80" rows="5" name="test_message[content]"></textarea>
				</td>
			</tr>
		</table>

		<p>
			<button type="submit" name="action" value="send_test" class="button-primary">
				<?php esc_html_e( 'Send Email', 'wp-mail-ses' ); ?>
			</button>
		</p>
	</form>
</div>

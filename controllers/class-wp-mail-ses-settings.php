<?php

class WP_Mail_SES_Settings {

	protected static $instance;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new self();
		}

		return static::$instance;
	}

	public function handle() {
		try {
			$this->post();
		} catch ( Exception $e ) {
			?>
				<div class="error fade">
					<p><?php echo esc_html( $e->getMessage() ); ?></p>
				</div>
			<?php
		}

		$this->index();
	}

	public function index() {
		include __DIR__ . '/../views/settings/index.php';
	}

	public function post() {
		if ( ! isset( $_POST['wp-mail-ses'] ) ) {
			return false;
		}

		if ( ! isset( $_POST['wp-mail-ses']['_nonce'] ) ) {
			return false;
		}

		if ( ! wp_verify_nonce(
			sanitize_key( $_POST['wp-mail-ses']['_nonce'] ),
			'wp-mail-ses'
		) ) {
			return;
		}

		$post_data = array_map( 'sanitize_text_field', wp_unslash( $_POST['wp-mail-ses'] ) );

		wp_mail(
			sanitize_email( $post_data['to'] ),
			sanitize_text_field( $post_data['subject'] ),
			sanitize_text_field( $post_data['content'] ),
			array(
				'From' => sprintf(
					'wp-mail-ses <%s>',
					sanitize_email( $post_data['from_email'] )
				),
			)
		);

		?>
			<div class="updated fade">
				<p><?php esc_html_e( 'Message sent', 'wp-mail-ses' ); ?></p>
			</div>
		<?php
	}
}

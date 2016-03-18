<?php

class WP_Mail_SES_Settings
{

    protected static $instance;

    public static function get_instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new self;
        }

        return static::$instance;
    }

    public function index()
    {
        try {
            if (array_key_exists('action', $_POST)) {
                switch ($_POST['action']) {
                    case 'send_test':
                        $this->send_test();
                }
            }
        } catch (Exception $e) {
            ?>
                <div class="error fade">
                    <p><?php echo $e->getMessage() ?></p>
                </div>
            <?php
        }

        include __DIR__ . '/../views/settings.php';
    }

    public function send_test() {
        if (!array_key_exists('test_message', $_POST)) {
            throw new Exception(
                __('Missing required parameters', 'wp-mail-ses')
            );
        }

        $required_params = array(
            'to' => __('Recipient Email', 'wp-mail-ses'), 
            'subject' => __('Subject', 'wp-mail-ses'), 
            'content' => __('Message (HTML)', 'wp-mail-ses')
        );

        foreach ($required_params as $required_param => $param_name) {
            if (!array_key_exists($required_param, $_POST['test_message'])) {
                throw new Exception(
                    __('Missing required parameter: ') . $param_name
                );
            }

            if (empty($_POST['test_message'][$required_param])) {
                throw new Exception(
                    __('Missing required parameter: ') . $param_name
                );
            }
        }

        wp_mail(
            $_POST['test_message']['to'],
            $_POST['test_message']['subject'],
            $_POST['test_message']['content']
        );

        ?>
            <div class="updated fade">
                <p><?php _e('Message sent', 'wp-mail-ses') ?></p>
            </div>
        <?php
    }
}

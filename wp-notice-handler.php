<?php
/**
 * WP Notice Handler
 *
 * @version 0.5
 * @author vl
 * @license MIT License http://www.opensource.org/licenses/mit-license.php
 */

/**
 * Class WP_Notice_Handler
 */
class WP_Notice_Handler {

    const NOTICE_SESSION = '_wp_notice_handler';

    const NOTICE = 'updated';
    const ERROR = 'error';

    private static $_instance = null;

    /**
     * @return WP_Notice_Handler
     */
    public static function i() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function add($message, $type = self::NOTICE) {
        $_SESSION[self::NOTICE_SESSION][] = ['msg' => $message, 'type' => $type];
    }

    /**
     * @access private
     */
    public function render() {
        if (isset($_SESSION[self::NOTICE_SESSION]) && is_array($_SESSION[self::NOTICE_SESSION])) {
            foreach ($_SESSION[self::NOTICE_SESSION] as $notice) {
                ?>
                <div class="<?= $notice['type'] ?>">
                    <p><?= $notice['msg'] ?></p>
                </div>
            <?php
            }
        }
        unset($_SESSION[self::NOTICE_SESSION]);
    }

    private function __construct() {
        if (session_id() == '') {
            session_start();
        }
        add_action('admin_notices', array($this, 'render'));
    }

    private function __clone() {
        ;
    }

}
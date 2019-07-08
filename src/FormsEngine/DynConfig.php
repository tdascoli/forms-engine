<?php
namespace FormsEngine;

class DynConfig {

    /**
     * @var Config
     */
    private static $_instance = null;

    /**
     * @var array
     */
    private $config;

    /**
     * Config constructor.
     */
    private function __construct() {
      // load json
      $this->config = require_once('system/config/config.php');
    }

    /**
     * Returns the instance.
     *
     * @static
     * @return \Config
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new Self;
        }

        return self::$_instance;
    }

    /**
     * Get a config item.
     *
     * @param $path
     *
     * @return mixed
     */
    public function get($path) {
        if (isset($path)) {
            $path   = explode('.', $path);
            $config = $this->config;

            foreach ($path as $key) {
                if (isset($config[$key])) {
                    $config = $config[$key];
                }
            }

            return $config;
        }
    }

    private function __clone() {}
    private function __wakeup() {}

    public function __destruct() {
        self::$_instance = null;
    }
}
?>

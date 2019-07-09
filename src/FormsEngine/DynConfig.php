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
    private function __construct($filename=null) {
        if ($filename==null){
            $filename = __DIR__ .'/config.json';
        }

        if (file_exists($filename)){
            $handle = fopen($filename,'r');
            $config = fread($handle, filesize($filename));
            fclose($handle);
            $this->config = json_decode($config);
        }
    }

    /**
     * Returns the instance.
     *
     * @static
     * @return \Config
     */
    public static function getInstance($filename=null)
    {
        if (self::$_instance == null) {
            self::$_instance = new Self($filename);
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
        /*
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
        */
        return $this->config->{$path};
    }

    private function __clone() {}

    private function __wakeup() {}

    public function __destruct() {
        self::$_instance = null;
    }
}
?>

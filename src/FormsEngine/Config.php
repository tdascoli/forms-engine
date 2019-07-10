<?php
namespace FormsEngine;

class Config {

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
        if (isset($_SESSION['configJson'])){
            $this->config = json_decode($_SESSION['configJson']);
        }
        else {
            $filename = __DIR__ .'/config.json';
            if (isset($_SESSION['configFile'])){
                $filename = $_SESSION['configFile'];
            }

            if (file_exists($filename)){
                $handle = fopen($filename,'r');
                $config = fread($handle, filesize($filename));
                fclose($handle);
                $this->config = json_decode($config);
            }
        }
    }

    /**
     * Returns the instance.
     *
     * @static
     * @return \Config
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new Self();
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
    public function get($path, $subpath = null) {
      if ($subpath!=null){
        return $this->prepare($subpath, $this->config->{$path}->{$subpath});
      }
      return $this->prepare($path, $this->config->{$path});
    }

    private function prepare($key, $value){
      if (stripos($key,'dir')>=0 && $this->config->addDirPrefix){
        return __DIR__ . $value;
      }
      return $value;
    }

    protected function __clone() {}

    protected function __wakeup() {}

    public function __destruct() {
        self::$_instance = null;
    }
}
?>

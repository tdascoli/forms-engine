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
      $filename = self::configFile();
      if (!empty($filename)){
        $config = file_get_contents($filename);
        $this->config = json_decode($config);
      }
    }

    private static function configFile(){
      try {
        if (isset($_SESSION['configFile'])){
            $filename = $_SESSION['configFile'];
            if (\file_exists($filename)){
              return $filename;
            }
            else {
              throw new \Exception("No configFile found: ".$filename);
            }
        }
        else {
          throw new \Exception("No _SESSION['configFile']");
        }
      } catch (\Exception $e) {
          echo 'Caught exception: ',  $e->getMessage(), "\n";
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
      if (stripos($key,'dir')===false){
        return $value;
      }
      else if ($this->config->addDirPrefix){
        if (isset($this->config->dirPrefix->{$key})){
          return $this->config->dirPrefix->{$key} . $value;
        }
        return __DIR__ . $value;
      }
      return $value;
    }

    public static function setDirPrefix($prefix, $dir){
      $filename = self::configFile();
      if (!empty($filename)){
        $configFile = file_get_contents($filename);
        $config = \json_decode($configFile);
        if (!isset($config->dirPrefix->$dir) || $config->dirPrefix->$dir != $prefix){
          $config->dirPrefix->$dir = $prefix;
          file_put_contents($filename, \json_encode($config, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
      }
    }

    protected function __clone() {}

    protected function __wakeup() {}

    public function __destruct() {
        self::$_instance = null;
    }
}
?>

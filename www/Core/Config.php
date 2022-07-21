<?php

namespace App\Core;
class Config
{
    private static $_instance;
    private $settings = [];

    private function __construct()
    {
        $this->settings = $this->getConfigfromFile();
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    public function getConfigfromFile()
    {
        return require('config.php');
    }

    public function varexport($expression, $return=FALSE) {
        $export = var_export($expression, TRUE);
        $patterns = [
            "/array \(/" => '[',
            "/^([ ]*)\)(,?)$/m" => '$1]$2',
            "/=>[ ]?\n[ ]+\[/" => '=> [',
            "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
        ];
        $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
        if ((bool)$return){
            return $export;
        } else{
            echo $export;
        }
    }

    public function saveConfig(array $array)
    {
        $file = 'config.php';
        foreach ($array as $key => $value) {
            foreach ($this->settings as $index => $value){
                if(array_key_exists($key, $this->settings[$index])){
                    $this->settings[$index][$key] = $array[$key];
                }
            }
        }
        $content = '<?php return ' . $this->varexport($this->settings, true) . ';';
        file_put_contents($file, $content);
    }

    public function get($key)
    {
        foreach ($this->settings as $index => $value) {
            if(array_key_exists($key, $this->settings[$index])){
                return $this->settings[$index][$key];
            }
        }
        return null;
    }
}

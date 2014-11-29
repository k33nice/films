<?php

/**
 * Class Config
 */
class Config {
    /**
     * @var null
     */
    private static $_instance = null;
    /**
     * @var array|mixed
     */
    public $options = array();

    /**
     * Retrieves php array file, json file, or ini file and builds array
     * @param $filepath Full path to where the file is located
     * @param $type is the type of file.  can be "ARRAY" "JSON" "INI"
     */
    private function __construct($filepath, $type = 'ARRAY')
    {
        $this->options = include $filepath;
    }

    /**
     * @param $filepath
     * @param string $type
     * @return Config|null
     */
    public static function getInstance($filepath, $type = 'ARRAY')
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self($filepath, $type);
        }
        return self::$_instance;
    }

    private function __clone()
    {
    }

    /**
     * Retrieve value with constants being a higher priority
     * @param $key Array Key to get
     */
    public function __get($key)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }
    }

    /**
     * Set a new or update a key / value pair
     * @param $key Key to set
     * @param $value Value to set
     */
    public function __set($key, $value)
    {
        $this->options[$key] = $value;
    }

}
<?php defined('APPPATH') or die();

/**
 * Class MySQL
 */
class MySQL {

    function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return Config|null
     */
    public static function connect()
    {
        $configs = Config::getInstance(APPPATH . '/application/config/database.php');

        /**
         * Concatenate PDO connection configurations
         * (Like PDO('mysql:host=localhost;port=3306;dbname=database', 'username', 'password')
         * To change configurations amend file '/application/config/database.php'
         */
        $dsn = $configs->driver . ":" .
                "host=" . $configs->host . ";" .
                "port=" . $configs->port . ";" .
                "dbname=" . $configs->database;
        $username = $configs->username;
        $password = $configs->password;
        $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        return $pdo = new PDO($dsn, $username, $password, $opt);
    }
}
<?php
namespace hasscms\system\helpers;
/**
 * Class SystemInfo
 * @package trntv\systeminfo
 */
class SystemInfo {
    
    
    public static function getSystemInfo()
    {
        return \ezcSystemInfo::getInstance();
    }
    /**
     * @return string
     */
    public static function getPhpVersion(){
        return phpversion();
    }

    /**
     * @return string
     */
    public static function getHostname(){
        return php_uname('n');
    }

    /**
     * @return string
     */
    public static function getArchitecture(){
        return php_uname('m');
    }
    
    public static function getOsVersion()
    {
        return php_uname('r');
    }


    /**
     * @return mixed
     */
    public static function getServerIP(){
        return isset($_SERVER['LOCAL_ADDR']) ? $_SERVER['LOCAL_ADDR'] : $_SERVER['SERVER_ADDR'];
    }

    /**
     * @return string
     */
    public static function getExternalIP(){
        return @file_get_contents('http://ipecho.net/plain');
    }

    /**
     * @return mixed
     */
    public static function getServerSoftware(){
      // list($severSoft) =  explode(" ", $_SERVER['SERVER_SOFTWARE']);
       return  $_SERVER['SERVER_SOFTWARE'];
    }

    /**
     * @param int $what
     * @return string
     */
    public static function getPhpInfo($what = -1){
        ob_start();
        phpinfo($what);
        return ob_get_clean();
    }

    /**
     * @return array
     */
    public static function getPHPDisabledFunctions(){
        return array_map('trim',explode(',',ini_get('disable_functions')));
    }


    /**
     * @param integer $key
     * @return mixed string|array
     */
    public static function getLoadAverage($key = false){
        if(!function_exists("sys_getloadavg"))
        {
            return "";
        }
        
        $la = array_combine([1,5,15], sys_getloadavg());
        return ($key !== false && isset($la[$key])) ? $la[$key] : $la;
    }
 
    /**
     * @param \PDO $connection
     * @return mixed
     */
    public static function getDbInfo(\PDO $connection){
        return $connection->getAttribute(\PDO::ATTR_SERVER_INFO);
    }

    /**
     * @param \PDO $connection
     * @return mixed
     */
    public static function getDbType(\PDO $connection){
        return $connection->getAttribute(\PDO::ATTR_DRIVER_NAME);
    }

    /**
     * @param $connection
     * @return string
     */
    public static function getDbVersion($connection){
        if(is_a($connection, 'PDO')){
            return $connection->getAttribute(\PDO::ATTR_SERVER_VERSION);
        } else {
            return mysqli_get_server_info($connection);
        }
    }
} 
?>
<?php

class DB { 
    
    private static $objInstance; 

    private function __construct() {} 

    private function __clone() {} 
    
    public static function getInstance() { 
        if(!self::$objInstance){ 
            self::$objInstance = new PDO(PDO_DRIVER.':host='.PDO_HOST.';dbname='.PDO_BASE.';charset=UTF8', PDO_USERNAME, PDO_PASSWORD); 
            self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } 
        return self::$objInstance; 
    
    } 
    
    final public static function __callStatic($chrMethod, $arrArguments) { 
        $objInstance = self::getInstance(); 
        return call_user_func_array(array($objInstance, $chrMethod), $arrArguments); 
        
    }
    
} 
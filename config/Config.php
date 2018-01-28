<?php

class Config {

    protected static $settings = array();

    public static function get($key) {

        return isset(self::$settings[$key]) ? self::$settings[$key] : null;

    } // end method

    public static function set($key, $value) {

        self::$settings[$key] = $value;

    }  // end method


}// end class

?>
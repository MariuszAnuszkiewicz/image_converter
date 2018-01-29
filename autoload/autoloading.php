<?php

define('ROOT', dirname(dirname(__FILE__)));

function autoloader($class) {

    $pos_start = strripos($class, '\\');
    $pos_end = strlen($class);
    $class_name = substr(ltrim($class), $pos_start, $pos_end);

    $pathMain = ROOT . '/' . $class_name . '.php';
    $pathClasses = ROOT . '/classes/' . str_replace($class_name, '', $class) . '.php';
    $configClasses = ROOT . '/config/' . str_replace($class_name, '', $class) . '.php';

    if (file_exists($pathMain)) {

        require_once '' . $pathMain . '';

    } else if (file_exists($pathClasses)) {

        require_once '' . $pathClasses . '';

    } else if (file_exists($configClasses)) {

        require_once '' . $configClasses . '';
    }
}

spl_autoload_register('autoloader');


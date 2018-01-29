<?php

define('ROOT', dirname(dirname(__FILE__)));

function autoloader($class) {

    $namespaces = ['line_of_table\\', 'header_of_table\\'];

    $pathMain = ROOT . '/' . $class . '.php';
    $pathClasses = ROOT . '/classes/' . str_replace($namespaces, '', $class) . '.php';
    $configClasses = ROOT . '/config/' . str_replace($namespaces, '', $class) . '.php';
    $dfddfdf;

    if (file_exists($pathMain)) {

        require_once '' . $pathMain . '';

    } else if (file_exists($pathClasses)) {

        require_once '' . $pathClasses . '';

    } else if (file_exists($configClasses)) {

        require_once '' . $configClasses . '';

    }

}

spl_autoload_register('autoloader');


?>
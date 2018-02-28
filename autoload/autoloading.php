<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', dirname(dirname(__FILE__)));
}

function autoloadSources($class) {

    $pos_start = strripos($class, '\\');
    $pos_end = strlen($class);
    $class_name = substr(ltrim($class), $pos_start, $pos_end);
    $file_class = ROOT . DS . '/classes/' . DS . str_replace('\\', DS, ucfirst($class_name)) . '.php';

    if($pos_start) {
        if (is_readable($file_class)) {
            require_once "$file_class";
        }
    }
    else {
        throw new Exception('Failed to include class '. $class_name);
    }
}

spl_autoload_register('autoloadSources');



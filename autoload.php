<?php
spl_autoload_register(function ($class_name) {
    
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    $path_lib = 'common/';
    $file = $path_lib . $filename;
    if (file_exists($file) === false) {
        throw new Exception('Undefined class', 500);
    }
    include $file;
    
});

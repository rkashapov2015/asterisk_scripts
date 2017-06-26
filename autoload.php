<?php
spl_autoload_register(function ($class_name) {
    
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    $paths_lib = array(
        '',
        'common/'
    );
    foreach ($paths_lib as $path) {
        $file = $path . $filename;
        
        if (file_exists($file)) {
            include $file;
            return true;
        }
    }
    throw new Exception('Undefined class', 500);
    
});

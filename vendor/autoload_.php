<?php

spl_autoload_register(function ($className) {

    $filePath = str_replace('', DIRECTORY_SEPARATOR, $className);
    $fullPath = $filePath . '.class.php';

    if (file_exists($fullPath)) {
        require_once($fullPath);
    }

});
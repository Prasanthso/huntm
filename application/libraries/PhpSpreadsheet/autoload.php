<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/src/PhpSpreadsheet/'; // Set the base directory
    $class = str_replace('PhpOffice\\PhpSpreadsheet\\', '', $class);
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        die("Error: Class file not found - " . $file);
    }
});

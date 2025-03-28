<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load PhpSpreadsheet manually
require_once APPPATH . 'libraries/PhpSpreadsheet/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PhpSpreadsheet_Lib {
    public function __construct() {
        // Ensure PhpSpreadsheet is available
        if (!class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet')) {
            die("Error: PhpSpreadsheet not found. Check your setup.");
        }
    }

    public function loadSpreadsheet($filePath) {
        if (!file_exists($filePath)) {
            die("Error: File not found - " . $filePath);
        }

        return IOFactory::load($filePath);
    }
}

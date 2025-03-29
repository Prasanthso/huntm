<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';  // Load Composer libraries

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends CI_Controller {

    public function upload() {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size']      = 3048; // 3MB limit

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excel_file')) {
            show_error("Upload Failed: " . $this->upload->display_errors());
            return;
        }

        $fileData = $this->upload->data();
        $filePath = $fileData['full_path'];

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 🔹 1. Remove Merge & Wrap Text
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();
        $fullRange = 'A1:' . $highestColumn . $highestRow; // Select entire sheet
        $sheet->getStyle($fullRange)->getAlignment()->setWrapText(false);
        $sheet->getStyle($fullRange)->getAlignment()->setHorizontal('general');

        // 🔹 2. Sort Consumer ID (Assume it's in column A)
        $data = $sheet->toArray();
        array_shift($data); // Remove headers

        usort($data, function($a, $b) {
            return strcmp($a[0], $b[0]); // Sort by first column (Consumer ID)
        });

        // Write sorted data back to sheet
        $sheet->fromArray(array_merge([['Consumer ID', 'Mobile Number']], $data));

        // 🔹 3. Find Duplicate Mobile Numbers (Assume it's in column B)
        $mobiles = [];
        $duplicates = [];
        foreach ($data as $row) {
            $mobile = $row[1]; // Assuming mobile numbers are in column B
            if (isset($mobiles[$mobile])) {
                $duplicates[] = $mobile;
            } else {
                $mobiles[$mobile] = true;
            }
        }

        // Save the corrected file
        $correctedFileName = 'processed_' . $fileData['file_name'];
        $correctedFilePath = './uploads/' . $correctedFileName;
        $writer = new Xlsx($spreadsheet);
        $writer->save($correctedFilePath);

        // Redirect to download the corrected file
        redirect(base_url('ExcelController/download/' . $correctedFileName));
    }

    public function download($filename) {
        $filePath = './uploads/' . $filename;

        if (file_exists($filePath)) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            show_error("File not found.");
        }
    }
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class FileModel extends CI_Model {

    public function processExcel($filePath) {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        // Process Data
        $data = $this->cleanData($data);

        // Save back to file
        $sheet->fromArray($data, null, 'A1');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filePath);

        echo json_encode(['success' => 'Excel processed successfully']);
    }

    public function processCSV($filePath) {
        $data = array_map('str_getcsv', file($filePath));
        $data = $this->cleanData($data);

        $fp = fopen($filePath, 'w');
        foreach ($data as $line) {
            fputcsv($fp, $line);
        }
        fclose($fp);
        echo json_encode(['success' => 'CSV processed successfully']);
    }

    public function processText($filePath) {
        $data = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $cleanedData = array_unique($data);
        sort($cleanedData);

        file_put_contents($filePath, implode("\n", $cleanedData));
        echo json_encode(['success' => 'TXT processed successfully']);
    }

    private function cleanData($data) {
        // Convert to associative array for sorting
        $headers = array_shift($data);
        $consumerIdIndex = array_search('Consumer ID', $headers);
        $mobileNumberIndex = array_search('Mobile Number', $headers);

        if ($consumerIdIndex !== false) {
            usort($data, function ($a, $b) use ($consumerIdIndex) {
                return $a[$consumerIdIndex] <=> $b[$consumerIdIndex];
            });
        }

        // Remove duplicate mobile numbers
        if ($mobileNumberIndex !== false) {
            $seenNumbers = [];
            $filteredData = [];

            foreach ($data as $row) {
                $mobile = $row[$mobileNumberIndex];
                if (!in_array($mobile, $seenNumbers)) {
                    $seenNumbers[] = $mobile;
                    $filteredData[] = $row;
                }
            }
            $data = $filteredData;
        }

        // Reapply headers
        array_unshift($data, $headers);
        return $data;
    }
}

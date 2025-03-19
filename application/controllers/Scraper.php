<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scraper extends CI_Controller {

    public function index() {
        $this->load->view('scraper_form'); // Load input form
    }

    public function scrape() {
        $url = $this->input->post('url');

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Fetch HTML using cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
            $html = curl_exec($ch);
            curl_close($ch);

            // Load HTML into DOMDocument
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            
            // Extract tables
            $tables = [];
            $tableTags = $dom->getElementsByTagName('table');

            foreach ($tableTags as $table) {
                $tables[] = $dom->saveHTML($table);
            }

            // Pass table data to the view
            $data = ['tables' => $tables];
            $this->load->view('scraper_view', $data);
        } else {
            echo "Invalid URL!";
        }
    }
}

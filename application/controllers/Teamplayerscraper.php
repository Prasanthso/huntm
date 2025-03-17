<?php
defined('BASEPATH') OR exit("No direct script access allowed");

class Teamplayerscraper extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        // Ensure default values are passed to avoid "undefined variable" errors
        $data = [
            'selectedTeam' => '',
            'selectedOption' => '',
            'playersList' => []
        ];
        $this->load->view('team_player_scraper_form', $data);
    }

    public function scrape() {
        $url = $this->input->post('url');
        $teamSide = $this->input->post('team');
        $option = $this->input->post('options');

        if (empty($url) || empty($teamSide) || empty($option)) {
            $data = [
                'error' => "All fields are required!",
                'selectedTeam' => $teamSide,
                'selectedOption' => $option,
                'playersList' => []
            ];
            $this->load->view('team_player_scraper_form', $data);
            return;
        }

        $playersList = $this->scrapeData($url, $teamSide, $option);
        $data = [
            'playersList' => $playersList,
            'selectedTeam' => $teamSide,
            'selectedOption' => $option
        ];
        $this->load->view('team_player_scraper_form', $data);
    }

    private function scrapeData($url, $teamSide, $option) {
        if (!file_exists(APPPATH . 'third_party/simple_html_dom.php')) {
            return ["Error: simple_html_dom.php file not found!"];
        }

        include_once(APPPATH . 'third_party/simple_html_dom.php');

        $html = file_get_html($url);
        if (!$html) {
            return ["Error: Unable to fetch data from the URL."];
        }

        $teamClass = ($teamSide === "right") ? ".cb-player-name-right" : ".cb-player-name-left";
        $players = [];

        foreach ($html->find($teamClass) as $player) {
            $fullText = trim($player->plaintext);

            // Extract player name
            $name = preg_replace('/\s?\(.*?\)|\b(Batter|WK-Batter|WK|Allrounder|Bowler|Coach.*?|Fielding Coach|Bowling Consultant|Pace Bowling Consultant)\b/i', '', $fullText);
            $name = trim($name);

            // Extract role
            preg_match('/\b(Batter|WK-Batter|WK|Allrounder|Bowler|Coach.*?|Fielding Coach|Bowling Consultant|Pace Bowling Consultant)\b/i', $fullText, $status);
            $role = $status[0] ?? '';

            if ($option === 'status') {
                $players[] = $role ? "<b>Player Name: </b>" . htmlspecialchars($name) . "<br>" . "<b>Role: </b>" . htmlspecialchars($role) . "<br><br>" : "$name - Unknown";
            } elseif ($option === 'bowler' && stripos($role, "Bowler") !== false) {
                $players[] = htmlspecialchars($name);
            } elseif ($option === 'coach' && stripos($role, "Coach") !== false) {
                $players[] = htmlspecialchars($name);
            } else {
                if (preg_match('/Batter|WK-Batter|WK|Allrounder/i', $role)) {
                    $players[] = htmlspecialchars($name);
                }
            }
        }

        return $players ?: ["No players found for the selected team and option."];
    }
}
?>

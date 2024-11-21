<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSantriModel extends Model
{
    public function fetchDataFromGoogleSheet($spreadsheetId, $sheet)
    {
        // configure the Google Client
        $client = new \Google_Client();
        $client->setApplicationName('Google Sheets API');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        // credentials.json is the key file we downloaded while setting up our Google Sheets API
        $path = 'key/fluid-catfish-440422-e3-c6e0c018c69a.json';
        $client->setAuthConfig($path);

        // configure the Sheets Service
        $service = new \Google_Service_Sheets($client);

        // the spreadsheet id can be found in the url like https://docs.google.com/spreadsheets/d/143xVs9lPopFSF4eJQWloDYAndMor/edit
        $spreadsheetId = $spreadsheetId;
        $spreadsheet = $service->spreadsheets->get($spreadsheetId);

        // Fetch the rows
        $range = $sheet;
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $rows = $response->getValues();
        // Remove the first one that contains headers
        $headers = array_shift($rows);
        // Combine the headers with each following row
        $array = [];
        foreach ($rows as $row) {
            $array[] = array_combine($headers, $row);
        }

        return $array;
    }
}

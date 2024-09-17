<?php

namespace app\Services\Google;

use Google\Service\Exception;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

class GoogleSheetsService
{
    private Google_Service_Sheets $service;

    public function __construct(GoogleConnection $connection)
    {
        $this->service = $connection();
    }

    /**
     * @throws Exception
     */
    public function get(string $spreadsheetId, string $range = 'Список пользователей!A2:H1000'): array
    {
        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);

        return $response->getValues();
    }

    /**
     * @throws Exception
     */
    public function update(array $updateData, string $spreadsheetId, string $range = 'Список пользователей!H2'): void
    {
        $body = new Google_Service_Sheets_ValueRange([
            'values' => array_values($updateData),
        ]);
        $options = array('valueInputOption' => 'RAW');

        $this->service->spreadsheets_values->update($spreadsheetId, $range, $body, $options);
    }
}

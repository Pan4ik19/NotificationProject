<?php

namespace app\Services\Google;

use Google_Client;
use Google_Service_Sheets;

class GoogleConnection
{
   public Google_Service_Sheets $service;

   public function __construct()
   {
       $client = new Google_Client();
       $client->useApplicationDefaultCredentials();
       $client->addScope('https://www.googleapis.com/auth/spreadsheets');
       $this->service = new Google_Service_Sheets($client);
   }

   public function __invoke(): Google_Service_Sheets
   {
       return $this->service;
   }

}

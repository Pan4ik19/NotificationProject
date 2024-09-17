<?php

namespace app\Console\Commands;

use app\Services\Data\DataUpdateService;
use app\Services\Google\GoogleConnection;
use app\Services\Google\GoogleSheetsService;
use Google\Service\Exception;
use Illuminate\Console\Command;

class NotificationScriptCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notification-script';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $googleService = new GoogleSheetsService(new GoogleConnection());
        $entries = $googleService->get(env('GOOGLE_LIST_ID'));

        $dataUpdateService = new DataUpdateService($entries);
        $updateData = $dataUpdateService->handle();

        if($updateData !== $entries){
            $updateData = array_map(function ($entry) {
                return array($entry[7]);
            }, $updateData);

            $googleService->update($updateData, env('GOOGLE_LIST_ID'));
        }

        echo 'successfully';
    }
}

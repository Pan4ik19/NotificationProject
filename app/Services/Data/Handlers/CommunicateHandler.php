<?php

namespace app\Services\Data\Handlers;

use app\Jobs\Notifications\SendEmailJob;
use app\Services\Data\DTO\UsersDTO;
use Carbon\Carbon;

class CommunicateHandler implements HandleInterface
{
    public function handle(UsersDTO $entry): UsersDTO
    {
        $communicate = $entry->getCommunicate();

        if ($communicate !== '') {
            $isDayCommunicate = Carbon::createFromFormat(HandleInterface::communicateDateFormat, $communicate)
                ->diffInDays(Carbon::today()) >= 14;

            if ($isDayCommunicate) {
                SendEmailJob::dispatch($entry->getName(), $entry->getEmail(), SendEmailJob::communicateKey)
                    ->onQueue('emails');
                $entry->setCommunicate(Carbon::now()->format('d.m.y'));
            }
        }

        return $entry;
    }
}

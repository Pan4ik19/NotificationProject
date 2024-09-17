<?php

namespace app\Services\Data\Handlers;

use App\Jobs\Notifications\SendEmailJob;
use app\Services\Data\DTO\UsersDTO;
use Carbon\Carbon;

class BirthdayHandler implements HandleInterface
{
    public function handle(UsersDTO $entry): UsersDTO
    {
        $birthday = $entry->getBirthday();

        if ($birthday !== '') {
            $isBirthday = Carbon::createFromFormat(HandleInterface::birthdayDateFormat, $birthday)
                ->isBirthday();
            $isNotCommunicate = !Carbon::createFromFormat(HandleInterface::communicateDateFormat, $entry->getCommunicate())
                ->isSameDay(Carbon::today());

            if ($isBirthday && $isNotCommunicate) {
                SendEmailJob::dispatch($entry->getName(), $entry->getEmail(), SendEmailJob::birthdayKey)
                    ->onQueue('emails');
                $entry->setCommunicate(Carbon::now()->format('d.m.y'));
            }
        }

        return $entry;
    }
}

<?php

namespace app\Services\Data\Handlers;

use app\Jobs\Notifications\SendEmailJob;
use app\Services\Data\DTO\UsersDTO;
use Carbon\Carbon;

class TwoWeeksBirthdayHandler implements HandleInterface
{
    public function handle(UsersDTO $entry): UsersDTO
    {
        $birthday = $entry->getBirthday();

        if ($birthday !== '') {
            $isBirthday = Carbon::createFromFormat(HandleInterface::birthdayDateFormat, $birthday)
                ->isBirthday(Carbon::now()->addWeeks(2));

            $isNotCommunicate = !Carbon::createFromFormat(HandleInterface::communicateDateFormat, $entry->getCommunicate())
                ->isSameDay(Carbon::now());

            if ($isBirthday && $isNotCommunicate) {
                SendEmailJob::dispatch($entry->getName(), $entry->getEmail(), SendEmailJob::twoWeeksBirthdayKey)
                    ->onQueue('emails');
                $entry->setCommunicate(Carbon::now()->format('d.m.y'));
            }
        }

        return $entry;
    }
}

<?php

namespace app\Services\Data;

use app\Services\Data\DTO\UsersDTO;
use app\Services\Data\Handlers\BirthdayHandler;
use app\Services\Data\Handlers\CommunicateHandler;
use app\Services\Data\Handlers\HandleInterface;
use app\Services\Data\Handlers\TwoWeeksBirthdayHandler;

class DataUpdateService
{
    private BirthdayHandler $birthdayHandler;
    private CommunicateHandler $communicateHandler;
    private TwoWeeksBirthdayHandler $twoWeeksBirthdayHandler;
    private array $handles;
    private array $userDTOArray;

    public function __construct(array $entries)
    {
        $this->handles = [
            $this->birthdayHandler = new BirthdayHandler(),
            $this->twoWeeksBirthdayHandler = new TwoWeeksBirthdayHandler(),
            $this->communicateHandler = new CommunicateHandler()
        ];

        $this->userDTOArray = array_map(function ($entry) {
            return new UsersDTO($entry);
        }, $entries);
    }

    public function handle(): array
    {
        $updateData = $this->userDTOArray;

        foreach ($this->handles as $handler){
            $updateData = array_map(function (UsersDTO $entry) use ($handler) {
                return $handler->handle($entry);
            }, $updateData);
        }

        return array_map(function (UsersDTO $entry){
            return $entry->getAll();
        }, $updateData);
    }


}

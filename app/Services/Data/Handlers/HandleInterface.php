<?php

namespace app\Services\Data\Handlers;

use app\Services\Data\DTO\UsersDTO;

interface HandleInterface
{
    public const birthdayDateFormat = 'd.m.Y';
    public const communicateDateFormat = 'd.m.y';

    public function handle(UsersDTO $entry): UsersDTO;
}

<?php

declare(strict_types=1);

namespace App\Services\DTO;

class GameDTO
{
    public function __construct(
        private int $userId,
        private int $random_number,
        private int $winSum,
        private bool $isWinNumber
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRandomNumber(): int
    {
        return $this->random_number;
    }

    public function getWinSum(): int
    {
        return $this->winSum;
    }

    public function isWinNumber(): bool
    {
        return $this->isWinNumber;
    }
}

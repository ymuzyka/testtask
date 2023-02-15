<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\RegisterInterface;
use App\Repositories\RegisterRepository;

class RegisterService implements RegisterInterface
{
    public function __construct(
        private RegisterRepository $registerRepository,
    ) {
    }

    public function register(string $name, string $phoneNumber): int
    {
        return $this->registerRepository->create($name, $phoneNumber);
    }
}

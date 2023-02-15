<?php

declare(strict_types=1);

namespace App\Interfaces;

interface RegisterInterface
{
    public function register(string $name, string $phoneNumber): int;
}

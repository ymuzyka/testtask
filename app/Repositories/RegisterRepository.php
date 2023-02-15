<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class RegisterRepository
{
    public function create(string $name, string $phoneNumber): int
    {
        $user = new User();
        $user->name = $name;
        $user->phone = $phoneNumber;
        $user->save();
        return $user->id;
    }
}

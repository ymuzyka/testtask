<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property DateTime $created_at
 */
class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'phone',
    ];

    public $timestamps = false;
}

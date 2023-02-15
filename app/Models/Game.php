<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $random_number
 * @property int $win_sum
 * @property boolean $is_win_number
 * @property DateTime $created_at
 */
class Game extends Model
{
    protected $table = 'game';

    protected $fillable = [
        'user_id',
        'random_number',
        'win_sum',
        'is_win_number',
    ];

    public $timestamps = false;
}

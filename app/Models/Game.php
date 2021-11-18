<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'grid',
        'user_turn'
    ];

    public static function createNewGame(){
        return self::create([
            'grid' => json_encode([1 => null,2 => null,3 => null,4 => null,5 => null,6 => null,7=> null,8 => null,9 => null]),
            'active' => true,
            'user_turn' => 1,
        ])->id;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandmarkUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_landmark',
        'is_favourite',
        'status',
        'mark'
    ];
}

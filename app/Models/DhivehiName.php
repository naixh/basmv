<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DhivehiName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'image',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'discussion_id',
        'user_id',
        'comment',
    ];

    protected $with = ['commentor:id,name,image,email'];

    public function discussion(){
        return $this->belongsTo(Discussion::class);
    }

    public function commentor(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

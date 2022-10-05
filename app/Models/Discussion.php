<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    protected $with = ['creator:id,name,image,email'];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function lastComment(){
        return $this->hasOne(Comment::class)->latest();
    }

    public function scopeOwned($query){
        return $query->where('user_id', auth()->id());
    }
}

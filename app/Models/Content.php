<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message'
    ];

    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

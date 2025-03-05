<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['website_name', 'link'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'link_user', 'link_id', 'user_id')
            ->withTimestamps(); // If you want to use the timestamps in the pivot table
    }
}

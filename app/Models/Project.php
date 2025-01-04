<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;

    // $table->foreignId('user_id')->references('id')->on('users');

    // $table->string('title');
    // $table->text('description'); // make validation 500
    // $table->text('contributions'); // make validation 1000

    protected $fillable = 
    [
        'user_id',
        'title',
        'description',
        'contributions'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}

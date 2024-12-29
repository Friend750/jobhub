<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentHistoryUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'employment_history_id',
        'user_id',
    ];

    public function employmenthistory()
    {
        return $this->belongsTo(EmploymentHistory::class,'employment_history_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

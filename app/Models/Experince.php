<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmploymentHistory extends Model
{
    use HasFactory,SoftDeletes;


    // $table->string('job_title'); // Job title
    // $table->string('company_name'); // Employer's name    
    // $table->date('start_date')->nullable(); // Start date of employment
    // $table->date('end_date')->nullable(); // End date of employment
    // $table->text('description')->nullable(); // Description of the employment role
    // $table->text('location')->nullable(); // Description of the employment role
    // $table->timestamps(); // created_at and updated_at columns

    protected $fillable = [
        'job_title',
        'company_name',
        'start_date',
        'end_date',
        'location',
        'description',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Define the relationship with the User model.
     * Employment history belongs to a user.
     */
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'employment_histories_with_user', 'employment_history_id', 'user_id');
    // }
}

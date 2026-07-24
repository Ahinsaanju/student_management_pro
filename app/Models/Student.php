<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use App\Models\Result;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'student_reg_no',
    'first_name',
    'last_name',
    'email',
    'dob',
    'gender',
    'status',
    'course'
];
    public function results()
    {
        return $this->hasMany(\App\Models\Result::class, 'student_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

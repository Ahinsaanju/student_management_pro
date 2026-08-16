<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';

    protected $fillable = [
        'student_id',
        'subject_code',
        'subject_name',
        'marks',
        'grade',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
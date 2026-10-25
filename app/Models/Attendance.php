<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'module_id',
        'date',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // 👨‍🎓 Student Relationship (මෙන්න මේ කොටස එකතු කරන්න)
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // 📚 Module Relationship
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    // 📖 Course Relationship
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
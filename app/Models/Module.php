<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'course_id',
        'module_code',
        'name',
        'credits'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

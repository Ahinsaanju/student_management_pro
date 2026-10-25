<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    use HasFactory;
    protected $fillable = ['module_id', 'title', 'description', 'type', 'file_path', 'external_url', 'uploaded_by'];

    public function module()
    {
        return $table = $this->belongsTo(Module::class);
    }
}

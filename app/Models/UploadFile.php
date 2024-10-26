<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'file_name',
        'file_type',
        'file_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

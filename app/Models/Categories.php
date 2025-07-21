<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id');
    }
    public function fileUpload()
    {
        return $this->hasMany(UploadFile::class);
    }
}

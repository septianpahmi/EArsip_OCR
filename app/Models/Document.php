<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'type_id',
        'user_id',
        'upload_at',
        'expired_at',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function type()
    {
        return $this->belongsTo(DocumentType::class, 'type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fileUpload()
    {
        return $this->hasMany(UploadFile::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'document_tags');
    }
}

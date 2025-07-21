<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    protected $fillable = [
        'document_id',
        'file_path',
        'file_name',
        'extension',
        'file_size',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function tags()
    {
        return $this->document ? $this->document->tags() : null;
    }
}

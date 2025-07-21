<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTag extends Model
{
    protected $fillable = [
        'document_id',
        'tag_id',
    ];

    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'document_id',
        'remind_at',
        'message',
        'is_sent',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}

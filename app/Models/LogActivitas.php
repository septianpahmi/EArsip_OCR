<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivitas extends Model
{
    protected $fillable = [
        'user_id',
        'document_id',
        'action'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}

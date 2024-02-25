<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'content', 'url', 'uid', 'published', 'read', 'feed_id',
    ];

    protected $casts = [
        'published' => 'datetime',
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }

    public function scopeRead($query)
    {
        return $query->where('read', true);
    }

    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
}

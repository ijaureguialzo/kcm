<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'content', 'url', 'uid', 'published', 'feed_id',
    ];

    protected $casts = [
        'published' => 'datetime',
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}

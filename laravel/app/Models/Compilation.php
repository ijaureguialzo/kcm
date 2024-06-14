<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compilation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'published',
        'repository_id',
    ];

    protected $casts = [
        'published' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->repository->title
            . ' - ' . $this->title;
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', '<=', now());
    }
}

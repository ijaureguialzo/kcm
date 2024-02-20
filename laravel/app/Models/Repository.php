<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'public',
        'user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function subscribers()
    {
        return $this
            ->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot([
                'role_id',
            ]);
    }

    public function compilations()
    {
        return $this->hasMany(Compilation::class);
    }
}

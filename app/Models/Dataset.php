<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dataset extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'file_path',
        'data',
        'source',
        'year',
        'is_published',
    ];

    protected $casts = [
        'data' => 'array',
        'is_published' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($dataset) {
            if (empty($dataset->slug)) {
                $dataset->slug = Str::slug($dataset->title);
            }
        });
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}

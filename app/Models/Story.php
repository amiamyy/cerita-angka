<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Story extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'dataset_id',
        'visualization_type',
        'chart_config',
        'content',
        'thumbnail',
        'is_featured',
        'is_published',
        'views',
    ];

    protected $casts = [
        'chart_config' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($story) {
            if (empty($story->slug)) {
                $story->slug = Str::slug($story->title);
            }
        });
    }

    public function dataset()
    {
        return $this->belongsTo(Dataset::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}

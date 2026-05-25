<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'link',
        'category_id',
        'project_type',
        'thumbnail',
        'github_url',
        'live_url',
        'featured',
        'status',
        'short_description',
        'technologies'
    ];

    protected $casts = [
        'technologies' => 'json',
        'featured' => 'boolean',
    ];

    protected $table = 'projects';

    /**
     * Get the category of the project.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    /**
     * Get the sections of the project.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(ProjectSection::class)->orderBy('sort_order');
    }

    /**
     * Get the media for the project.
     */
    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class)->orderBy('sort_order');
    }

    /**
     * Scope to filter by category.
     */
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Scope to filter featured projects.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope to filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to search projects.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%");
    }
}

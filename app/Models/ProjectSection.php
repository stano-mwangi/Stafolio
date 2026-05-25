<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectSection extends Model
{
    protected $fillable = [
        'project_id',
        'section_type',
        'title',
        'content',
        'image',
        'gallery',
        'metadata',
        'sort_order'
    ];

    protected $casts = [
        'gallery' => 'json',
        'metadata' => 'json',
    ];

    protected $table = 'project_sections';

    /**
     * Get the project of this section.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get supported section types.
     */
    public static function getSectionTypes()
    {
        return [
            'text' => 'Text Block',
            'image' => 'Single Image',
            'gallery' => 'Image Gallery',
            'code' => 'Code Block',
            'notebook_step' => 'Notebook Step',
            'metrics' => 'Metrics/Stats',
            'visualization' => 'Chart/Visualization',
            'timeline' => 'Timeline',
            'embedded_video' => 'Embedded Video',
            'features' => 'Features List'
        ];
    }
}

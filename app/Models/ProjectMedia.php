<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    protected $fillable = [
        'project_id',
        'path',
        'type',
        'alt_text',
        'caption',
        'sort_order'
    ];

    protected $table = 'project_media';

    /**
     * Get the project of this media.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get supported media types.
     */
    public static function getMediaTypes()
    {
        return [
            'image' => 'Image',
            'video' => 'Video',
            'document' => 'Document'
        ];
    }
}

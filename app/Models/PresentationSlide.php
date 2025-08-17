<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PresentationSlide
 *
 * @property int $id
 * @property int $presentation_id
 * @property int $slide_number
 * @property string $title
 * @property string|null $content
 * @property string|null $image_path
 * @property string|null $image_url
 * @property array|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\Presentation $presentation
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide query()
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide wherePresentationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereSlideNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PresentationSlide whereUpdatedAt($value)
 * @method static \Database\Factories\PresentationSlideFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PresentationSlide extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'presentation_id',
        'slide_number',
        'title',
        'content',
        'image_path',
        'image_url',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'presentation_id' => 'integer',
        'slide_number' => 'integer',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the presentation that owns the slide.
     */
    public function presentation(): BelongsTo
    {
        return $this->belongsTo(Presentation::class);
    }
}
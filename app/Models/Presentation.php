<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Presentation
 *
 * @property int $id
 * @property string $title
 * @property string $filename
 * @property string $file_path
 * @property string $file_type
 * @property int $file_size
 * @property int $total_slides
 * @property string $status
 * @property bool $is_active
 * @property string|null $thumbnail_path
 * @property array|null $metadata
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PresentationSlide[] $slides
 * @property-read int|null $slides_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereThumbnailPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereTotalSlides($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Presentation active()
 * @method static \Database\Factories\PresentationFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Presentation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'filename',
        'file_path',
        'file_type',
        'file_size',
        'total_slides',
        'status',
        'is_active',
        'thumbnail_path',
        'metadata',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'file_size' => 'integer',
        'total_slides' => 'integer',
        'is_active' => 'boolean',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the presentation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the slides for the presentation.
     */
    public function slides(): HasMany
    {
        return $this->hasMany(PresentationSlide::class)->orderBy('slide_number');
    }

    /**
     * Scope a query to only include active presentations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
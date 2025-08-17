<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DashboardContent
 *
 * @property int $id
 * @property string $title
 * @property string $content_type
 * @property string|null $content
 * @property string|null $media_url
 * @property string|null $media_type
 * @property int $display_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property string|null $background_color
 * @property string|null $text_color
 * @property array|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereMediaType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereMediaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent active()
 * @method static \Illuminate\Database\Eloquent\Builder|DashboardContent published()
 * @method static \Database\Factories\DashboardContentFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class DashboardContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'content_type',
        'content',
        'media_url',
        'media_type',
        'display_order',
        'is_active',
        'published_at',
        'expires_at',
        'background_color',
        'text_color',
        'metadata',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active content.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include published content.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }
}
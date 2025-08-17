<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Achievement
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $metric_type
 * @property float $value
 * @property float|null $target_value
 * @property string|null $unit
 * @property string $period
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $category
 * @property string|null $color
 * @property bool $is_active
 * @property string|null $onedrive_sheet_id
 * @property string|null $onedrive_range
 * @property \Illuminate\Support\Carbon|null $last_synced_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereLastSyncedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereMetricType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereOnedriveRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereOnedriveSheetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereTargetValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement active()
 * @method static \Database\Factories\AchievementFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Achievement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'metric_type',
        'value',
        'target_value',
        'unit',
        'period',
        'date',
        'category',
        'color',
        'is_active',
        'onedrive_sheet_id',
        'onedrive_range',
        'last_synced_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'float',
        'target_value' => 'float',
        'is_active' => 'boolean',
        'date' => 'datetime',
        'last_synced_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active achievements.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
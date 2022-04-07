<?php

namespace App\Models;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\DuesCategory
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|DuesCategory newModelQuery()
 * @method static Builder|DuesCategory newQuery()
 * @method static Builder|DuesCategory query()
 * @method static Builder|DuesCategory whereCode($value)
 * @method static Builder|DuesCategory whereCreatedAt($value)
 * @method static Builder|DuesCategory whereDescription($value)
 * @method static Builder|DuesCategory whereId($value)
 * @method static Builder|DuesCategory whereName($value)
 * @method static Builder|DuesCategory whereStatus($value)
 * @method static Builder|DuesCategory whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static Builder|DuesCategory whereCreatedBy($value)
 * @method static Builder|DuesCategory whereUpdatedBy($value)
 * @property float $amount
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DuesDetail[] $duesDetail
 * @property-read int|null $dues_detail_count
 * @method static Builder|DuesCategory whereAmount($value)
 */
class DuesCategory extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_DUES_CATEGORY;

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function duesDetail(): HasMany
    {
        return $this->hasMany(DuesDetail::class,"dues_category_id","id");
    }

}

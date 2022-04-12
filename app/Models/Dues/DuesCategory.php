<?php

namespace App\Models\Dues;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Dues\DuesCategory
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property float $amount
 * @property string|null $description
 * @property string $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|DuesDetail[] $duesDetail
 * @property-read int|null $dues_detail_count
 * @method static Builder|DuesCategory newModelQuery()
 * @method static Builder|DuesCategory newQuery()
 * @method static Builder|DuesCategory query()
 * @method static Builder|DuesCategory whereAmount($value)
 * @method static Builder|DuesCategory whereCode($value)
 * @method static Builder|DuesCategory whereCreatedAt($value)
 * @method static Builder|DuesCategory whereCreatedBy($value)
 * @method static Builder|DuesCategory whereDescription($value)
 * @method static Builder|DuesCategory whereId($value)
 * @method static Builder|DuesCategory whereName($value)
 * @method static Builder|DuesCategory whereStatus($value)
 * @method static Builder|DuesCategory whereUpdatedAt($value)
 * @method static Builder|DuesCategory whereUpdatedBy($value)
 * @mixin Eloquent
 */
class DuesCategory extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_DUES_CATEGORY;

    protected $guarded = [];

    protected $casts = [
        "created_at"=> "datetime:Y-m-d H:i:s",
        "updated_at"=> "datetime:Y-m-d H:i:s",
    ];

    /**
     * @return HasMany
     */
    public function duesDetail(): HasMany
    {
        return $this->hasMany(DuesDetail::class,"dues_category_id","id");
    }

}

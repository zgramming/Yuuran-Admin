<?php

namespace App\Models;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\DuesDetail
 *
 * @property string $id
 * @property int $dues_category_id
 * @property int $users_id
 * @property int $month
 * @property int $year
 * @property float $amount
 * @property string $status
 * @property int $paid_by_someone_else
 * @property string|null $description
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DuesCategory $duesCategory
 * @property-read User $user
 * @method static Builder|DuesDetail newModelQuery()
 * @method static Builder|DuesDetail newQuery()
 * @method static Builder|DuesDetail query()
 * @method static Builder|DuesDetail whereAmount($value)
 * @method static Builder|DuesDetail whereCreatedAt($value)
 * @method static Builder|DuesDetail whereCreatedBy($value)
 * @method static Builder|DuesDetail whereDescription($value)
 * @method static Builder|DuesDetail whereDuesCategoryId($value)
 * @method static Builder|DuesDetail whereId($value)
 * @method static Builder|DuesDetail whereMonth($value)
 * @method static Builder|DuesDetail wherePaidBySomeoneElse($value)
 * @method static Builder|DuesDetail whereStatus($value)
 * @method static Builder|DuesDetail whereUpdatedAt($value)
 * @method static Builder|DuesDetail whereUpdatedBy($value)
 * @method static Builder|DuesDetail whereUsersId($value)
 * @method static Builder|DuesDetail whereYear($value)
 * @mixin Eloquent
 */
class DuesDetail extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_DUES_DETAIL;

    protected $casts = [
        'id' => "string",
    ];


    protected $guarded = [];

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), \Str::uuid());
        });
    }
    /**
     * @return BelongsTo
     */
    public function duesCategory(): BelongsTo
    {
        return $this->belongsTo(DuesCategory::class, "dues_category_id", "id");
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "users_id", "id");
    }

}

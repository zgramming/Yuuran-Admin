<?php

namespace App\Models;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\DuesDetail
 *
 * @property int $id
 * @property int $dues_id
 * @property int $dues_category_id
 * @property int $users_id
 * @property float $amount
 * @property string $status
 * @property int $paid_by_someone_else
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|DuesDetail newModelQuery()
 * @method static Builder|DuesDetail newQuery()
 * @method static Builder|DuesDetail query()
 * @method static Builder|DuesDetail whereAmount($value)
 * @method static Builder|DuesDetail whereCreatedAt($value)
 * @method static Builder|DuesDetail whereDescription($value)
 * @method static Builder|DuesDetail whereDuesCategoryId($value)
 * @method static Builder|DuesDetail whereDuesId($value)
 * @method static Builder|DuesDetail whereId($value)
 * @method static Builder|DuesDetail wherePaidBySomeoneElse($value)
 * @method static Builder|DuesDetail whereStatus($value)
 * @method static Builder|DuesDetail whereUpdatedAt($value)
 * @method static Builder|DuesDetail whereUsersId($value)
 * @mixin Eloquent
 */
class DuesDetail extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_DUES_DETAIL;

    protected $guarded = [];

}

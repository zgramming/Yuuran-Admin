<?php

namespace App\Models;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Dues
 *
 * @property int $id
 * @property int $users_id
 * @property string $code Format Code : username:UUIDV4
 * @property string $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Dues newModelQuery()
 * @method static Builder|Dues newQuery()
 * @method static Builder|Dues query()
 * @method static Builder|Dues whereCode($value)
 * @method static Builder|Dues whereCreatedAt($value)
 * @method static Builder|Dues whereDate($value)
 * @method static Builder|Dues whereId($value)
 * @method static Builder|Dues whereUpdatedAt($value)
 * @method static Builder|Dues whereUsersId($value)
 * @mixin Eloquent
 */
class Dues extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_DUES;

    protected $guarded = [];

}

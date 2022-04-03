<?php

namespace App\Models;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 */
class DuesCategory extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_DUES_CATEGORY;

    protected $guarded = [];

}

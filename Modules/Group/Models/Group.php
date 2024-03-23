<?php

namespace Modules\Group\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'groups';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Group\database\factories\GroupFactory::new();
    }
}

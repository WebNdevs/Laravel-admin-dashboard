<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMessage extends Model
{
    use HasFactory;

    protected $table = 'daily_message';
    protected $primaryKey = 'id';

    function sechedual_id(){
        return $this->hasMany('Modules\Schedule\Models\Schedule', 'id', 'schedule_id');
    }

    function customer_id(){
        return $this->hasMany('Modules\Customer\Models\Customer', 'id', 'customer_id');
    }
}

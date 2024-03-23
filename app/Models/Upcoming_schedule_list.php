<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upcoming_schedule_list extends Model
{
    use HasFactory;

    protected $table = 'upcoming_schedule_list';
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id', 
        'schedule_id',
        'upcoming_date',
        'status'
    ];

    protected $attributes = [
        'customer_id' => 0,
        'schedule_id' => 0, // Default value
        'upcoming_date' => '2023-05-25',
        'status' => 0
    ];
    

}

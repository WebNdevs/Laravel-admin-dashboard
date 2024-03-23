<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Total_Balance extends Model
{
    use HasFactory;

    protected $primarykey = "id";
    protected $table = "customer_total_balance";
}

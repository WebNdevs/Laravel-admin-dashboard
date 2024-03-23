<?php

namespace Modules\PaymentReceived\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Models\Company;
use Modules\Customer\Models\Customer;
class PaymentReceived extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'paymentreceiveds';
    protected $primarykey = 'id';
    
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function customer()
   {
       return $this->belongsTo(Customer::class, 'customer', 'id');
   }
    public function company()
   {
       return $this->belongsTo(Company::class, 'company', 'id');
   }

    protected static function newFactory()
    {
        return \Modules\PaymentReceived\database\factories\PaymentReceivedFactory::new();
    }
}

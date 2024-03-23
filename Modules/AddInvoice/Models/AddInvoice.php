<?php

namespace Modules\AddInvoice\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customer\Models\Customer;
use Modules\Company\Models\Company;
class AddInvoice extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'addinvoices';
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
        return \Modules\AddInvoice\database\factories\AddInvoiceFactory::new();
    }
}

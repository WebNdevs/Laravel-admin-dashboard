<?php

namespace Modules\PaymentReceived\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class PaymentReceivedsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'PaymentReceiveds';

        // module name
        $this->module_name = 'paymentreceiveds';

        // directory path of the module
        $this->module_path = 'paymentreceived::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\PaymentReceived\Models\PaymentReceived";
    }

}

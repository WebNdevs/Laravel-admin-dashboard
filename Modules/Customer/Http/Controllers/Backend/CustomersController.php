<?php

namespace Modules\Customer\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class CustomersController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Customers';

        // module name
        $this->module_name = 'customers';

        // directory path of the module
        $this->module_path = 'customer::backend';

        // module icon
        $this->module_icon = 'fa-solid fa-users';

        // module model name, path
        $this->module_model = "Modules\Customer\Models\Customer";
    }

}

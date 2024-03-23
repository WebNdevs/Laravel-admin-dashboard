<?php

namespace Modules\AddInvoice\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class AddInvoicesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'AddInvoices';

        // module name
        $this->module_name = 'addinvoices';

        // directory path of the module
        $this->module_path = 'addinvoice::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\AddInvoice\Models\AddInvoice";
    }

}

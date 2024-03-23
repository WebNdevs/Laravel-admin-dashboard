<?php

namespace Modules\Company\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class CompaniesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Companies';

        // module name
        $this->module_name = 'companies';

        // directory path of the module
        $this->module_path = 'company::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Company\Models\Company";
    }

}

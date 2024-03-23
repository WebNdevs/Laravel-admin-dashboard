<?php

namespace Modules\Group\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class GroupsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Groups';

        // module name
        $this->module_name = 'groups';

        // directory path of the module
        $this->module_path = 'group::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Group\Models\Group";
    }

}

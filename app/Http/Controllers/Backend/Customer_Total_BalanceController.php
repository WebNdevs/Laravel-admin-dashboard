<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer_Total_Balance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class Customer_Total_BalanceController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Customer Total Balance';
        
        // href Link
        $this->module_link = 'Customer_Total_Balance';

        // module name
        $this->module_name = 'Customer_Total_Balance';

        // directory path of the module
        $this->module_path = 'customertotalbalance';

        // module icon
        $this->module_icon = 'fas fa-cogs';

        // module model name, path
        $this->module_model = "App\Models\Customer_Total_Balance";
    }

     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   
}


<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use Modules\Group\Models\Group;
use Modules\Customer\Models\Customer;
class DailyRatesController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;
    public $module_link;


    public function __construct()
    {
        // Page Title
        $this->module_title = 'Daily Rates';
        
        // href Link
        $this->module_link = 'dailyrates';

        // module name
        $this->module_name = 'dailyrates';

        // directory path of the module
        $this->module_path = 'dailyrates';

        // module icon
        $this->module_icon = 'fas fa-cogs';

       
    }

    public function index()
    {
       
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_link = $this->module_link;
        $module_icon = $this->module_icon;
 
        $groups = Group::get();

        $module_action = 'List';
        
        Log::info(label_case($module_title.' '.$module_action).' | User:'.Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_path.index",
            compact('module_title', 'module_name', 'module_path', 'module_link', 'module_icon', 'module_action', 'groups')
        );
    }
    
    public function send(Request $request){
        $module_title = $this->module_title;
        $module_path = $this->module_path;
        $groupid = $request['group_id'];
        $group = $request['group'];
        $price = $request['price'];
        $customergroup = Customer::where('group', $groupid)->get();

        foreach ($customergroup as $customer) {
         
            $message = "Hi  ". $customer->name  . " This is " .$group. ". Today steel price is " . $price;
            // $message = "Hi  ". $customer->name  . " This is vandana group. " .$group. " Today steel price is " . $price;
            Log::error($message);
        }
        Flash::success("<i class='fas fa-check'></i> " . $module_title.  " Message Sent Successfully")->important();
        return redirect("admin/$module_path");
        
    }
}

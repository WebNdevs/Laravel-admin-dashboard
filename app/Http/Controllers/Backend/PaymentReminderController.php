<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use App\Models\Customer_Total_Balance;
use Modules\Customer\Models\Customer;
use Modules\Company\Models\Company;
class PaymentReminderController extends Controller
{
    public $module_title;
    
    public $module_link;

    public $module_name;

    public $module_path;

    public $module_icon;


    public function __construct()
    {
        // Page Title
        $this->module_title = 'Payment Reminder';
        
        // href Link
        $this->module_link = 'paymentreminder';

        // module name
        $this->module_name = 'paymentreminder';

        // directory path of the module
        $this->module_path = 'paymentreminder';

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
 
        $companiesArray = customer_total_balance::distinct('company')->pluck('company');
        $customersArray = customer_total_balance::distinct('customer')->pluck('customer');
        
        $latestBalances = customer_total_balance::whereIn('company', $companiesArray)
            ->whereIn('customer', $customersArray)
            ->groupBy(['customer', 'company'])
            ->select('customer', 'company', \DB::raw('MAX(created_at) as latest_created_at'))
            ->get();
        
        $module_action = 'List';
        
        Log::info(label_case($module_title.' '.$module_action).' | User:'.Auth::user()->name.'(ID:'.Auth::user()->id.')');

        return view(
            "backend.$module_path.index",
            compact('module_title', 'module_name', 'module_path', 'module_link', 'module_icon', 'module_action', 'latestBalances')
        );

        
    }

    public function send(Request $request)
    {
        $module_title = $this->module_title;
        $module_path = $this->module_path;
        $id =  $request['id'];
        $latestBalanceRecord = customer_total_balance::where('id', $id)->get();
        foreach ($latestBalanceRecord as $customer) {
            $customerName = Customer::find($customer->customer)->name;
            $companyName = Company::find($customer->company)->name;
         
            $message = "Hi ". $customerName  . " This is Company. " .$companyName. " Steel Due Balance is " . $customer->balance;
            Log::error($message);
        }
       Flash::success("<i class='fas fa-check'></i> " . $module_title.  " Message Sent Successfully")->important();
       return redirect("admin/$module_path");
    }
    
}

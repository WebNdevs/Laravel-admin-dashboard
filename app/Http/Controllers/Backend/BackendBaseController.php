<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Models\Customer_Total_Balance;

class BackendBaseController extends Controller
{
    use Authorizable;

    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Modules';

        // module name
        $this->module_name = 'modules';

        // directory path of the module
        $this->module_path = 'backend';

        // module icon
        $this->module_icon = 'fas fa-tags';

        // module model name, path
        $this->module_model = "App\Models\BaseModel";

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::paginate();

        logUserAccess($module_title.' '.$module_action);

        return view(
            "$module_path.$module_name.index_datatable",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    /**
     * Select Options for Select 2 Request/ Response.
     *
     * @return Response
     */
    public function index_list(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $query_data = $module_model::where('name', 'LIKE', "%$term%")->orWhere('slug', 'LIKE', "%$term%")->limit(7)->get();

        $$module_name = [];

        foreach ($query_data as $row) {
            $$module_name[] = [
                'id' => $row->id,
                'text' => $row->name.' (Slug: '.$row->slug.')',
            ];
        }

        return response()->json($$module_name);
    }

    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading.' '.label_case($module_action);
        if( $module_name == 'reminders'){
            $$module_name = $module_model::select('id', 'name', 'updated_at','frequency','template');
        }elseif( $module_name == 'customers'){
            
            $$module_name = $module_model::select('id', 'name', 'email' ,'updated_at');

        }elseif( $module_name == 'companies'){
            $$module_name = $module_model::select('id', 'name','updated_at');
        }else{
            $$module_name = $module_model::select('id', 'name','updated_at');
        }

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', '<strong>{{$name}}</strong>')
            ->editColumn('updated_at', function ($data) {
                $module_name = $this->module_name;

                $diff = Carbon::now()->diffInHours($data->updated_at);

                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                } else {
                    return $data->updated_at->isoFormat('llll');
                }
            })
            ->rawColumns(['name', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }


    public function addinvoices_data()
    {

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading.' '.label_case($module_action);

        if ($module_name == 'addinvoices' || $module_name == 'paymentreceiveds') {
            $data = $module_model::with(['company:id,name', 'customer:id,name'])
                ->select('id', 'company', 'customer', 'updated_at')
                ->get();
        } 
        
        return Datatables::of($data)
            ->addColumn('action', function ($data) use ($module_name) {
                $datas = $data;
                return view('backend.includes.action_column', compact('module_name', 'data'));
            })
            ->editColumn('name', function ($data) {
                $companyName = $data->company;
                $customerName = optional($data->customer)->name;
        
                return '<strong>Company: ' . $companyName . ', Customer: ' . $customerName . '</strong>';
            })
            ->editColumn('updated_at', function ($data) {
                $diff = Carbon::now()->diffInHours($data->updated_at);
        
                if ($diff < 25) {
                    return $data->updated_at->diffForHumans();
                } else {
                    return $data->updated_at->isoFormat('llll');
                }
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
        

        }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        logUserAccess($module_title.' '.$module_action);
        
        return view(
            "$module_path.$module_name.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        if($module_name == "customers"){
            $token = $request['_token'];
            $name = $request['name'];
            $email = $request['email'];
            $contact = $request['contact'];
            $group = $request['group'];
            $status = $request['status'];
            
            $data = ['_token' => $token, 'name' => $name, 'email' => $email, 'contact' => $contact, 'group' => $group, 'status' => $status];
            
            $module_action = 'Store';
            $$module_name_singular = $module_model::create($data);
            flash("<i class='fas fa-check'></i> New '".Str::singular($module_title)."' Added")->success()->important();
            logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);
            return redirect("admin/$module_name");

        }else{
            $module_action = 'Store';

            $$module_name_singular = $module_model::create($request->all());

            if ($module_name == 'addinvoices' || $module_name == 'paymentreceiveds') {

                $requestData = $request->all();

                $customer = $requestData['customer'];
                $company = $requestData['company'];

                $customerTotalBalanceData = Customer_Total_Balance::where('customer', $customer)
                    ->where('company', $company)
                    ->latest('created_at')
                    ->first();

                if ($customerTotalBalanceData) {

                    if ($module_name == 'paymentreceiveds') {

                        $customerTotalBalanceModel = new Customer_Total_Balance;
                        $customerTotalBalanceModel->customer = $customer;
                        $customerTotalBalanceModel->company = $company;
                        $customerTotalBalanceModel->deposit = 0;
                        $customerTotalBalanceModel->credit =  $requestData['payment'];
                        $customerTotalBalanceModel->status = 1;

                        $balance = $customerTotalBalanceData->balance - $requestData['payment'];

                        $customerTotalBalanceModel->balance = $balance;
                        $customerTotalBalanceModel->save();

                    } else {

                        $customerTotalBalanceModel = new Customer_Total_Balance;
                        $customerTotalBalanceModel->customer = $customer;
                        $customerTotalBalanceModel->company = $company;
                        $customerTotalBalanceModel->deposit = $requestData['amount'];
                        $customerTotalBalanceModel->credit =  0;
                        $customerTotalBalanceModel->status = 1;
                        $balance = $customerTotalBalanceData->balance + $requestData['amount'];
                        $customerTotalBalanceModel->balance = $balance;
                        $customerTotalBalanceModel->save();
                    }

                } elseif ($module_name == 'addinvoices') {
                    // Customer and company record does not exist, create a new record
                    $customerTotalBalanceModel = new Customer_Total_Balance;
                    $customerTotalBalanceModel->customer = $customer;
                    $customerTotalBalanceModel->company = $company;
                    $customerTotalBalanceModel->deposit = $requestData['amount'];
                    $customerTotalBalanceModel->credit =  0;
                    $customerTotalBalanceModel->status = 1;
                    $customerTotalBalanceModel->balance = $requestData['amount'];
                    $customerTotalBalanceModel->save();
                } elseif ($module_name == 'paymentreceiveds') {
                    $customerTotalBalanceModel = new Customer_Total_Balance;
                        $customerTotalBalanceModel->customer = $customer;
                        $customerTotalBalanceModel->company = $company;
                        $customerTotalBalanceModel->deposit = 0;
                        $customerTotalBalanceModel->credit =  $requestData['payment'];
                        $customerTotalBalanceModel->status = 1;

                        $customerTotalBalanceModel->balance = - $requestData['payment'];
                        $customerTotalBalanceModel->save();
                }
            }

            flash("<i class='fas fa-check'></i> New '".Str::singular($module_title)."' Added")->success()->important();

            logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

            return redirect("admin/$module_name");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        
        $module_action = 'Show';
        if($module_name == "customers"){
           
            $$module_name_singular = $module_model::findOrFail($id);

            $id = $$module_name_singular['id'];
            $name = $$module_name_singular['name'];
            $email = $$module_name_singular['email'];
            $contact = $$module_name_singular['contact'];
            $group = $$module_name_singular['group'];
            $status = $$module_name_singular['status'];
            $created_by = $$module_name_singular['created_by'];
            $updated_by = $$module_name_singular['updated_by'];
            $deleted_by = $$module_name_singular['deleted_by'];
            $created_at = $$module_name_singular['created_at'];
            $updated_at = $$module_name_singular['updated_at'];
            $deleted_at = $$module_name_singular['deleted_at'];
            $data = ['id' => $id, 'name' => $name, 'email' => $email, 'contact' => $contact, 'group' => $group,'status' => $status, 'created_by' => $created_by, 'updated_by' => $updated_by, 'deleted_by' => $deleted_by, 'created_at' => $created_at, 'updated_at' => $updated_at, 'deleted_at' => $deleted_at];

            $$module_name_singular = new $module_model;

            $$module_name_singular->id = $data['id'];
            $$module_name_singular->name = $data['name'];
            $$module_name_singular->email = $data['email'];
            $$module_name_singular->contact = $data['contact'];
            $$module_name_singular->group = $data['group'];
            $$module_name_singular->status = $data['status'];
            $$module_name_singular->created_by = $data['created_by'];
            $$module_name_singular->updated_by = $data['updated_by'];
            $$module_name_singular->deleted_by = $data['deleted_by'];
            $$module_name_singular->created_at = $data['created_at'];
            $$module_name_singular->updated_at = $data['updated_at'];
            $$module_name_singular->deleted_at = $data['deleted_at'];

            logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

            return view(
                "$module_path.$module_name.show",
                compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular")
            );

        }else{


            $$module_name_singular = $module_model::findOrFail($id);

            logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

            return view(
                "$module_path.$module_name.show",
                compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular")
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        
        $module_action = 'Edit';

       


            $$module_name_singular = $module_model::findOrFail($id);

            logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

            return view(
                "$module_path.$module_name.edit",
                compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular")
            );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        

        $module_action = 'Update';

        if($module_name == "customers"){

            $method = $request['_method'];
            $token = $request['_token'];
            $name = $request['name'];
            $email = $request['email'];
            $contact = $request['contact'];
            $group = $request['group'];
            $status = $request['status'];
            
            $data = ['_method'=> $method, '_token' => $token, 'name' => $name, 'email' => $email, 'contact' => $contact, 'group' =>$group, 'status' => $status];
            
            $$module_name_singular = $module_model::findOrFail($id);

            $$module_name_singular->update($data);

            flash("<i class='fas fa-check'></i> '".Str::singular($module_title)."' Updated Successfully")->success()->important();

            logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

            return redirect()->route("backend.$module_name.show", $$module_name_singular->id);

        }else{

            $$module_name_singular = $module_model::findOrFail($id);

            $$module_name_singular->update($request->all());

            flash("<i class='fas fa-check'></i> '".Str::singular($module_title)."' Updated Successfully")->success()->important();

            logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

            return redirect()->route("backend.$module_name.show", $$module_name_singular->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'destroy';

        $$module_name_singular = $module_model::findOrFail($id);

        $$module_name_singular->delete();

        flash('<i class="fas fa-check"></i> '.label_case($module_name_singular).' Deleted Successfully!')->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect("admin/$module_name");
    }

    /**
     * List of trashed ertries
     * works if the softdelete is enabled.
     *
     * @return Response
     */
    public function trashed()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Trash List';

        $$module_name = $module_model::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate();

        logUserAccess($module_title.' '.$module_action);

        return view(
            "$module_path.$module_name.trash",
            compact('module_title', 'module_name', 'module_path', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
        );
    }

    /**
     * Restore a soft deleted entry.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Restore';

        $$module_name_singular = $module_model::withTrashed()->find($id);
        $$module_name_singular->restore();

        flash('<i class="fas fa-check"></i> '.label_case($module_name_singular).' Data Restoreded Successfully!')->success()->important();

        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect("admin/$module_name");
    }
}

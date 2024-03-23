<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customer\Models\Customer;

class CsvImportController extends Controller
{
    public function index()
{
    return view('import-csv');
}

public function store(Request $request)
{
    $file = $request->file('csv_file');
   
    // Check if a file was uploaded

    
    if ($file) {
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $email = $row[1];    
                // Check if the email already exists in the database
                $existingCustomer = Customer::where('email', $email)->first();
    
                // If the email doesn't exist, insert the record
                if (!$existingCustomer) {
                    $customer = new Customer;
                    $customer->name = $row[0];
                    $customer->email = $email;
                    $customer->contact = $row[2];
                    $customer->group = $row[3];
                    $customer->status = 1;
                    $customer->save();
                }
            }
            fclose($handle);
        }
        
        return response()->json(['message' => 'CSV file imported successfully']);
        //return response()->json(['message' => $tags]);
    }
    

    return response()->json(['message' => 'No file uploaded'], 400);
}
}

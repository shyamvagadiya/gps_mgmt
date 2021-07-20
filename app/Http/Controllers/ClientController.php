<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Type;
use App\Application; 
use App\Client;
use App\Exports\BlankClientExport;
use App\Exports\ClientBlankExport;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportClientImport;
use App\Imports\ClientData;
use App\Vehicle;

class ClientController extends Controller
{
    public function index(request $request)
    {
        if($request->ajax())
        {
            $clients=Client::with('company','type','application');            
            
            
            //dd($request->company_id == null && $request->created_at == null && $request->city == null,date('Y-m-d'));
            if($request->has('company_id') && $request->company_id != null)
            {
                $clients=$clients->where('company',$request->company_id);
            }
            if($request->has('city') && $request->city != null)
            {
                $clients=$clients->where('city', 'like', '%' . $request->city . '%');   
            }
            if($request->has('created_at_start') && $request->created_at_start != null)
            {   
                $clients=$clients->whereDate('created_at', '>=', $request->created_at_start." 00:00:00");   
            }
            if($request->has('created_at_end') && $request->created_at_end != null)
            {   
                $clients=$clients->whereDate('created_at', '<=', $request->created_at_end." 23:59:00");   
            }
            // if($request->has('expiry_date') && $request->expiry_date != null)
            // {
            //     $clients=$clients->whereDate('expiry_date',$request->expiry_date);      
            // }
            // if($request->has('warranty') && $request->warranty != null)
            // {   
            //     $clients=$clients->where('warranty',$request->warranty);      
            // }
            $clients=$clients->orderBy('created_at','desc')->get();

            $html=view('client.dyanamicTable',compact('clients'))->render();

            return response()->json(['html'=>$html]);
        }
        
        $companies=Company::all();      
        $types=Type::all();
        $applications=Application::all();
        return view('client.index',compact('companies','types','applications'));
    }
    public function create()
    {
		$companies=Company::all();    	
		$types=Type::all();
		$applications=Application::all();
		$last_client=Client::orderBy('id','desc')->first();
		if($last_client)
		{
			$getLast=$last_client->customer_no;
			$getNumber=ltrim($getLast,"FZEE");
			if(intval($getNumber) < 10)
			{
				$number="000".(intval($getNumber)+1);
			}
			else if(intval($getNumber) > 10 && intval($getNumber) < 99)
			{
				$number="00".(intval($getNumber)+1);
			}
			else if(intval($getNumber) > 99 && intval($getNumber) < 999)
			{
				$number="0".(intval($getNumber)+1);
			}
			else
			{
				$number=(intval($getNumber)+1);
			}
			$customer_no="FZEE".$number;
            //dd(intval($getNumber));
		}   
		else
		{
			$customer_no="FZEE0001";
		} 	
    	return view('client.create',compact('companies','applications','types','customer_no'));
    }
    public function submit_client(request $request)
    {
    	//dd($request->all());die;
        // $payment_details=null;
        // if($request->mobile_no != null)
        // {
        //     $last_client=Client::where('mobile_no',$request->mobile_no)->where('payment_details','!=',null)->first();
        //     if($last_client)
        //     {
        //         $payment_details=$last_client->payment_details;
        //     }
        // }
        

    	$add=new Client;
    	$add->auth_id=\Auth::user()->id;
    	$add->customer_no=$request->customer_no;
    	$add->company=$request->company_id;
    	$add->customer_name=$request->customer_name;
    	$add->address=$request->address;
    	$add->city=$request->city;
    	$add->state=$request->state;
    	$add->mobile_no=$request->mobile_no;
        $add->alt_mobile_no=$request->alt_mobile_no;
        $add->created_at=$request->created_at." 00:00:00";
    	// $add->type_id=$request->type_id;
    	// $add->user_id=$request->user_id;
    	// $add->application_id=$request->application_id;
    	// $add->vehicle_no=$request->vehicle_no;
    	// $add->device_type=$request->device_type;
    	// $add->imei_no=$request->imei_no;
    	// $add->sim_no=$request->sim_no;
    	// $add->sim_operator=$request->sim_operator;
    	// $add->monthly_sim_charge=$request->monthly_sim_charge;
    	// $add->expiry_date=$request->expiry_date;
    	// $add->warranty=$request->warranty;
    	// $add->vehicle_status=$request->vehicle_status;
    	// $add->salesman=$request->salesman;
    	// $add->technician=$request->technician;
    	// $add->prepared_by=$request->prepared_by;
     //    $add->payment_details=$payment_details;
    	$add->save();	
    	return redirect()->back();
    }
    public function update_payment_modal(request $request)
    {
        $client_id=$request->client_id;
        $html=view('vehicle.dyanamicModal',compact('client_id'))->render();
        return response()->json(['html'=>$html]);
    }
    public function store_payment(request $request)
    {
        $client_upd=Vehicle::find($request->client_id);
        $client_upd->payment_details=$request->payment_details;
        $client_upd->save();

        $lastClinet=Vehicle::where('id',$request->client_id)->first();
        if($lastClinet)
        {
            $getClientSameDetails=Vehicle::where('client_id',$lastClinet->client_id)->get();
            if(count($getClientSameDetails) > 0)
            {
                foreach ($getClientSameDetails as $client) {
                    $clientUpd=Vehicle::find($client->id);
                    $clientUpd->payment_details=$request->payment_details;
                    $clientUpd->save();
                }
            }
        }

        return redirect()->back();
    }
    public function sim_management(request $request)
    {
        if($request->ajax())
        {
            $clients=Vehicle::with('client','type','application');

            if($request->company_id == null && $request->city == null && $request->created_at_start == null && $request->created_at_end == null && $request->expiry_date_start == null && $request->expiry_date_end == null && $request->warranty_start == null && $request->warranty_end == null)
            {
                $clients=$clients->whereDate('created_at',date('Y-m-d'));   
            }

            if($request->has('company_id') && $request->company_id != null)
            {
                $clients=$clients->whereHas('client',function($query) use ($request){
                    $query->where('company', 'like', '%' . $request->company_id . '%');
                });
            }
            if($request->has('city') && $request->city != null)
            {
                $clients=$clients->whereHas('client',function($query) use ($request){
                    $query->where('city', 'like', '%' . $request->city . '%');
                });
            }
            if($request->has('created_at_start') && $request->created_at_start != null)
            {   
                $clients=$clients->whereDate('created_at', '>=', $request->created_at_start." 00:00:00");
            }
            if($request->has('created_at_end') && $request->created_at_end != null)
            {   
                $clients=$clients->whereDate('created_at', '<=', $request->created_at_end." 23:59:00");   
            }

            if($request->has('expiry_date_start') && $request->expiry_date_start != null)
            {   
                $clients=$clients->whereDate('expiry_date', '>=', $request->expiry_date_start);   
            }
            if($request->has('expiry_date_end') && $request->expiry_date_end != null)
            {   
                $clients=$clients->whereDate('expiry_date', '<=', $request->expiry_date_end);   
            }

            if($request->has('warranty_start') && $request->warranty_start != null)
            {   
                $clients=$clients->whereDate('warranty', '>=', $request->warranty_start);   
            }
            if($request->has('warranty_end') && $request->warranty_end != null)
            {   
                $clients=$clients->whereDate('warranty', '<=', $request->warranty_end);   
            }
            $clients=$clients->get();

            $html=view('sim_management.dyanamicTable',compact('clients'))->render();

            return response()->json(['html'=>$html]);
        }
        
        $companies=Company::all();      
        $types=Type::all();
        $applications=Application::all();
        return view('sim_management.index',compact('companies','types','applications'));
    }
    public function downloadBlankExel()
    {
        return Excel::download(new BlankClientExport, 'SampleExcel.xlsx');
    }
    public function download_blank_excel_client()
    {
        return Excel::download(new ClientBlankExport, 'ClientSampleExcel.xlsx');   
    }
    public function import_data(request $request)
    {
        ini_set("max_execution_time","-1");
        //dd($request->has('file') && $request->file != null);
        if($request->has('file') && $request->file != null)
        {
            Excel::import(new ImportClientImport, $request->file);
        }
        return redirect()->back();
    }
    public function import_data_client(request $request)
    {
        ini_set("max_execution_time","-1");
        if($request->has('file') && $request->file != null)
        {
            Excel::import(new ClientData, $request->file);
        }
        return redirect()->back();
    }
    public function downloadReport(request $request)
    {
        return Excel::download(new ReportExport($request), 'Report.xlsx');
    }
    public function logout()
    {
        \Auth::logout();
        return redirect()->route('home');
    }
    public function load_data_autofill(request $request)
    {
        $response=[];
        // $lead_detail=Medicine::where('instruction_english', 'like', '%' . $request['query'] . '%')->where('instruction_english','!=',' ')->where('instruction_english','!=',null)->get();
        $lead_detail=Client::where('company', 'like', '%' . $request['query'] . '%')->get();
        if(count($lead_detail) > 0)
        {
            foreach ($lead_detail as $value) {
                $response[] = array("value"=>$value->company."(".$value->mobile_no.")","data"=>$value->id);
            }   
        }
        return json_encode(array("suggestions" => $response));
    }
    public function edit($id)
    {
        $client=Client::where('id',$id)->first();
        return view('client.edit',compact('client'));
    }
    public function update(request $request)
    {
        $add=Client::find($request->id);
        $add->auth_id=\Auth::user()->id;
        $add->customer_no=$request->customer_no;
        $add->company=$request->company_id;
        $add->customer_name=$request->customer_name;
        $add->address=$request->address;
        $add->city=$request->city;
        $add->state=$request->state;
        $add->mobile_no=$request->mobile_no;
        $add->alt_mobile_no=$request->alt_mobile_no;
        $add->created_at=$request->created_at." 00:00:00";
        $add->save();   
        return redirect()->route('show.client');
    }
    public function load_prev_data(request $request)
    {
        $vehicle=Vehicle::where('client_id',$request->customer_id)->orderBy('id','desc')->first();
        if($vehicle)
        {
            $array=['user_id'=>$vehicle->user_id,'dealer'=>$vehicle->dealer,'salesman'=>$vehicle->salesman];
        }
        else
        {
            $array=['user_id'=>"",'dealer'=>"",'salesman'=>""];
        }
        return response()->json($array);
    }   
}

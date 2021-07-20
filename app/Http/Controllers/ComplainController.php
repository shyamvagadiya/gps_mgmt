<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complain;
use App\Company;
use App\Client;
use App\Vehicle;

class ComplainController extends Controller
{
    public function index(request $request)
    {
    	if($request->ajax())
    	{
    		$complains=Complain::with('company');
    		if($request->has('company_id') && $request->company_id != null)
            {
                $complains=$complains->where('company', 'like', '%' . $request->company_id . '%');   
            }

            if($request->has('created_at_start') && $request->created_at_start != null)
            {
                $complains=$complains->whereDate('created_at', '>=', $request->created_at_start." 00:00:00");   
                //$complains=$complains->where('company', 'like', '%' . $request->company_id . '%');   
            }
            if($request->has('created_at_end') && $request->created_at_end != null)
            {
                $complains=$complains->whereDate('created_at', '<=', $request->created_at_end." 23:59:00");
                //$complains=$complains->where('company', 'like', '%' . $request->company_id . '%');   
            }

            if($request->has('city') && $request->city != null)
            {
                $complains=$complains->where('city', 'like', '%' . $request->city . '%');   
            }
    		//$complains=$complains->where('status','!=','Resolved')->get();
            $complains=$complains->get();
    		$html=view('complain_management.dyanamicTable',compact('complains'))->render();
    		return response()->json(['html'=>$html]);
    	}
    	$companies=Company::all();
    	return view('complain_management.index',compact('companies'));
    }
   	public function create(request $request)
   	{
   		return view('complain_management.create');
   	}	
   	public function load_data(request $request)
    {
        $response=[];
        // $lead_detail=Medicine::where('instruction_english', 'like', '%' . $request['query'] . '%')->where('instruction_english','!=',' ')->where('instruction_english','!=',null)->get();
        $lead_detail=Vehicle::where('vehicle_no', 'like', '%' . $request['query'] . '%')->orWhere('sim_no', 'like', '%' . $request['query'] . '%')->orWhere('imei_no', 'like', '%' . $request['query'] . '%')->get();
        if(count($lead_detail) > 0)
        {
            foreach ($lead_detail as $value) {
                $response[] = array("value"=>$value->vehicle_no." / ".$value->sim_no." / ".$value->imei_no,"data"=>$value->id);
            }   
        }
        return json_encode(array("suggestions" => $response));
    }
    public function get_client_data(request $request)
    {
    	$client=Vehicle::with('client')->where('id',$request->client_id)->first();
    	$html=view('complain_management.dyanamicDiv',compact('client'))->render();
    	return response()->json(['html'=>$html]);
    }
    public function store(request $request)
    {
    	$client=Vehicle::with('client')->where('id',$request->client_id)->first();
    	if($client)
    	{
    		$addComplain=new Complain;
    		$addComplain->customer_no=$client->client->customer_no;
    		$addComplain->company=$client->client->company;
    		$addComplain->customer_name=$client->client->customer_name;
    		$addComplain->address=$client->client->address;
    		$addComplain->city=$client->client->city;
    		$addComplain->state=$client->client->state;
    		$addComplain->mobile_no=$client->client->mobile_no;
    		$addComplain->vehicle_no=$client->vehicle_no;
    		$addComplain->device_type=$client->device_type;
    		$addComplain->imei_no=$client->imei_no;
    		$addComplain->sim_no=$client->sim_no;
    		$addComplain->sim_operator=$client->sim_operator;
    		$addComplain->complain=$request->complain;
            $addComplain->technician=$request->technician;
    		$addComplain->save();
    	}
    	return redirect()->route('complain.management');
    }
    public function mark_resolved(request $request)
    {
        $updStatus=Complain::find($request->id);
        $updStatus->status="Resolved";
        $updStatus->conclusion=$request->conclusion;
        $updStatus->save();
        
        return redirect()->back();
    }
    public function update_remarks(request $request)
    {
        $updStatus=Complain::find($request->id);
        $updStatus->remarks=$request->remarks;
        $updStatus->save();
        return redirect()->back();
    }
}

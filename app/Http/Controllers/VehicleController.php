<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Application;
use App\Vehicle;

class VehicleController extends Controller
{
    public function index(request $request)
    {
        if($request->ajax())
        {
            $clients=Vehicle::with('client','type','application');
            if($request->company_id == null && $request->created_at == null && $request->city == null && $request->expiry_date == null && $request->warranty == null && $request->comman_search == null)
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
            if($request->has('comman_search') && $request->comman_search != null)
            {
                $clients=$clients->where('user_id', 'like', '%' . $request->comman_search . '%')->orWhere('vehicle_no', 'like', '%' . $request->comman_search . '%')->orWhere('imei_no', 'like', '%' . $request->comman_search . '%')->orWhere('sim_no', 'like', '%' . $request->comman_search . '%')->orWhere('salesman', 'like', '%' . $request->comman_search . '%')->orWhere('dealer', 'like', '%' . $request->comman_search . '%')->orWhere('created_at', 'like', '%' . $request->comman_search . '%')->orWhere('expiry_date', 'like', '%' . $request->comman_search . '%')->orWhere('warranty', 'like', '%' . $request->comman_search . '%')->orWhere('vehicle_status', 'like', '%' . $request->comman_search . '%')->orWhere('vehicle_status', 'like', '%' . $request->comman_search . '%')->orWhereHas('client',function($query) use ($request){
                    $query->where('customer_no', 'like', '%' . $request->comman_search . '%')->orWhere('company', 'like', '%' . $request->comman_search . '%')->orWhere('customer_name', 'like', '%' . $request->comman_search . '%')->orWhere('city', 'like', '%' . $request->comman_search . '%')->orWhere('state', 'like', '%' . $request->comman_search . '%')->orWhere('mobile_no', 'like', '%' . $request->comman_search . '%')->orWhere('state', 'like', '%' . $request->comman_search . '%');
                	})->orWhereHas('type',function($query2) use ($request){
                    	$query2->where('name', 'like', '%' . $request->comman_search . '%');
                    })->orWhereHas('application',function($query3) use ($request){
                    	$query3->where('name', 'like', '%' . $request->comman_search . '%');
                    });
            }
            // if($request->has('created_at') && $request->created_at != null)
            // {   
            //     $clients=$clients->whereDate('created_at',$request->created_at);   
            // }

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

            $clients=$clients->orderBy('created_at','desc')->get();

            $html=view('vehicle.dyanamicTable',compact('clients'))->render();

            return response()->json(['html'=>$html]);
        }
    
        $types=Type::all();
        $applications=Application::all();
        return view('vehicle.index',compact('types','applications'));
    }

    public function create()
    {
		$types=Type::all();
		$applications=Application::all();	
    	return view('vehicle.create',compact('applications','types'));
    }
    public function store(request $request)
    {
    	//dd($request->all());die;
        $payment_details=null;
        if($request->mobile_no != null)
        {
            $last_client=Vehicle::where('mobile_no',$request->mobile_no)->where('payment_details','!=',null)->first();
            if($last_client)
            {
                $payment_details=$last_client->payment_details;
            }
        }

        if($request->sim_no != null)
        {
            $checkVehicleSim=Vehicle::where('sim_no',$request->sim_no)->where('sim_status','Active')->first();
            if($checkVehicleSim)
            {
                \Session::flash('message-error','SIM No already in use.');
                return redirect()->back();
            }

            $checkVehicleSimCheck=Vehicle::where('sim_no',$request->sim_no)->where('sim_status','Inactive')->first();
            if($checkVehicleSimCheck)
            {
                $deleteData=Vehicle::where('id',$checkVehicleSimCheck->id)->delete();
            }
        }
        

    	$add=new Vehicle;
    	$add->auth_id=\Auth::user()->id;
    	// $add->customer_no=$request->customer_no;
    	// $add->company=$request->company_id;
    	// $add->customer_name=$request->customer_name;
    	// $add->address=$request->address;
    	// $add->city=$request->city;
    	// $add->state=$request->state;
    	// $add->mobile_no=$request->mobile_no;
    	$add->client_id=$request->customer_id;
    	$add->type_id=$request->type_id;
    	$add->user_id=$request->user_id;
    	$add->application_id=$request->application_id;
    	$add->vehicle_no=$request->vehicle_no;
    	$add->device_type=$request->device_type;
    	$add->imei_no=$request->imei_no;
    	$add->sim_no=$request->sim_no;
    	$add->sim_operator=$request->sim_operator;
    	$add->monthly_sim_charge=$request->monthly_sim_charge;
    	$add->expiry_date=$request->expiry_date;
    	$add->warranty=$request->warranty;
    	$add->vehicle_status=$request->vehicle_status;
    	$add->salesman=$request->salesman;
    	$add->technician=$request->technician;
    	$add->prepared_by=$request->prepared_by;
        $add->payment_details=$payment_details;
        $add->dealer=$request->dealer;
        $add->created_at=$request->created_at." 00:00:00";
    	$add->save();	
    	return redirect()->back();
    }
    public function edit($id)
    {
        $vehicle=Vehicle::with('client')->where('id',$id)->first();
        $types=Type::all();
        $applications=Application::all();
        return view('vehicle.edit',compact('vehicle','types','applications'));
    }
    public function update_vehicle_status(request $request)
    {
        // $upd=Vehicle::find($request->id);
        // $upd->vehicle_status=$request->vehicle_status;
        // $upd->expiry_date=$request->expiry_date;
        // $upd->save();

        $add=Vehicle::find($request->id);
        $add->client_id=$request->customer_id;
        $add->auth_id=\Auth::user()->id;
        $add->type_id=$request->type_id;
        $add->user_id=$request->user_id;
        $add->application_id=$request->application_id;
        $add->vehicle_no=$request->vehicle_no;
        $add->device_type=$request->device_type;
        $add->imei_no=$request->imei_no;
        $add->sim_no=$request->sim_no;
        $add->sim_operator=$request->sim_operator;
        $add->monthly_sim_charge=$request->monthly_sim_charge;
        $add->expiry_date=$request->expiry_date;
        $add->warranty=$request->warranty;
        $add->vehicle_status=$request->vehicle_status;
        $add->salesman=$request->salesman;
        $add->technician=$request->technician;
        $add->prepared_by=$request->prepared_by;
        $add->dealer=$request->dealer;
        $add->created_at=$request->created_at." 00:00:00";
        $add->save();   

        return redirect()->route('show.vehicle');
    }
    public function inactive_sim($id)
    {
        $upd=Vehicle::find($id);
        $upd->sim_status='Inactive';
        $upd->expiry_date=date('Y-m-d');
        $upd->save();
        return redirect()->back();
    }
    public function active_sim($id)
    {
        $upd=Vehicle::find($id);
        $upd->sim_status='Active';
        $upd->save();
        return redirect()->back();
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Client;
use App\Vehicle;

class ReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $request = null;

     public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $request=$this->request;
        $clients=Vehicle::with('client','type','application');
        if($request->company_id == null && $request->created_at == null && $request->city == null && $request->expiry_date == null && $request->warranty == null && $request->comman_search == null)
        {
            $clients=$clients->whereDate('created_at',date('Y-m-d'));   
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
        $clients=$clients->orderBy('created_at','desc')->get();

        return view('vehicle.dyanamicTable', [
            'clients' => $clients
        ]);

        //return response()->json(['html'=>$html]);
    }
}

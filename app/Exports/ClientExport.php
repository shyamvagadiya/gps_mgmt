<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Client;
use App\Vehicle;

class ClientExport implements FromView
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
         
        $clients=Client::with('company','type','application');

        
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
        
        $clients=$clients->orderBy('created_at','desc')->get();


        return view('client.dyanamicTable', [
            'clients' => $clients
        ]);

        //return response()->json(['html'=>$html]);
    }
}

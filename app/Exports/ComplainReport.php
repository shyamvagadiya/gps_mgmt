<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Complain;
use App\Vehicle;

class ComplainReport implements FromView
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
         
        $complains=Complain::with('company');
		if($request->has('company_id') && $request->company_id != null)
        {
            $complains=$complains->where('company', 'like', '%' . $request->company_id . '%');   
        }
        if($request->has('city') && $request->city != null)
        {
            $complains=$complains->where('city', 'like', '%' . $request->city . '%');   
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
		//$complains=$complains->where('status','!=','Resolved')->get();
    	$complains=$complains->get();
        return view('complain_management.dyanamicTable', [
            'complains' => $complains
        ]);

        //return response()->json(['html'=>$html]);
    }
}

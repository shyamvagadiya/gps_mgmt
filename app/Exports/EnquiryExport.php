<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Enquiry;
use App\Vehicle;

class EnquiryExport implements FromView
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
         
        $enquires=Enquiry::with('company');
        if($request->company_id == null && $request->created_at_start == null && $request->created_at_end == null)
        {
            $enquires=$enquires->whereDate('created_at',date('Y-m-d'));   
        }
        if($request->has('company_id') && $request->company_id != null)
        {
            $enquires=$enquires->where('company', 'like', '%' . $request->company_id . '%');   
        }
        if($request->has('created_at_start') && $request->created_at_start != null)
        {   
            $enquires=$enquires->whereDate('created_at', '>=', $request->created_at_start." 00:00:00");   
        }
        if($request->has('created_at_end') && $request->created_at_end != null)
        {   
            $enquires=$enquires->whereDate('created_at', '<=', $request->created_at_end." 23:59:00");   
        }
        $enquires=$enquires->get();
    		
        return view('enquiry.dyanamicTable', [
            'enquires' => $enquires
        ]);

        //return response()->json(['html'=>$html]);
    }
}

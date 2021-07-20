<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Type;
use App\Application; 
use App\Client;
use App\Enquiry;

class EnquiryController extends Controller
{
    public function index(request $request)
    {
    	if($request->ajax())
        {
            $enquires=Enquiry::with('company');
            if($request->company_id == null && $request->created_at_start == null && $request->created_at_end == null)
            {
                $enquires=$enquires->whereDate('created_at',date('Y-m-d'));   
            }
            if($request->has('company_id') && $request->company_id != null)
            {
                $enquires=$enquires->where('company', 'like', '%' . $request->company_id . '%');   
            }
            // if($request->has('created_at') && $request->created_at != null)
            // {   
            //     $enquires=$enquires->whereDate('created_at',$request->created_at);   
            // }
            if($request->has('created_at_start') && $request->created_at_start != null)
            {   
                $enquires=$enquires->whereDate('created_at', '>=', $request->created_at_start." 00:00:00");   
            }
            if($request->has('created_at_end') && $request->created_at_end != null)
            {   
                $enquires=$enquires->whereDate('created_at', '<=', $request->created_at_end." 23:59:00");   
            }
            $enquires=$enquires->get();

            $html=view('enquiry.dyanamicTable',compact('enquires'))->render();

            return response()->json(['html'=>$html]);
        }
        
        $companies=Company::all();      
        
        return view('enquiry.index',compact('companies'));
    }
    public function create()
    {
    	$companies=Company::all();      
        return view('enquiry.create',compact('companies'));	
    }
    public function store(request $request)
    {
    	$addEnquiry = new Enquiry;
    	$addEnquiry->auth_id=\Auth::user()->id;
    	$addEnquiry->company = $request->company;
    	$addEnquiry->customer_name=$request->customer_name;
    	$addEnquiry->mobile_no=$request->mobile_no;
    	$addEnquiry->email=$request->email;
    	$addEnquiry->last_call=$request->last_call;
    	$addEnquiry->comment=$request->comment;
    	$addEnquiry->save();
    	return redirect()->route('show.enquiry');
    }
    public function modify_comment($id)
    {
        $enquiry=Enquiry::where('id',$id)->first();
        return view('enquiry.edit',compact('enquiry')); 
    }
    public function update(request $request)
    {
        $addEnquiry = Enquiry::find($request->id);
        $addEnquiry->auth_id=\Auth::user()->id;
        $addEnquiry->company = $request->company;
        $addEnquiry->customer_name=$request->customer_name;
        $addEnquiry->mobile_no=$request->mobile_no;
        $addEnquiry->email=$request->email;
        $addEnquiry->last_call=$request->last_call;
        $addEnquiry->comment=$request->comment;
        $addEnquiry->save();
        return redirect()->route('show.enquiry');
    }
}

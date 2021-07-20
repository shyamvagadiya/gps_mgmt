<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ClientExport;
use App\Exports\ComplainReport;
use App\Exports\SimExport;
use App\Exports\EnquiryExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function client_report(request $request)
    {
    	return Excel::download(new ClientExport($request), 'ClientReport.xlsx');
    }
    public function download_report_complain(request $request)
    {
    	return Excel::download(new ComplainReport($request), 'ComplainReport.xlsx');
    }
    public function download_report_sim(request $request)
    {
    	return Excel::download(new SimExport($request), 'SimReport.xlsx');
    }
    public function download_report_enquiry(request $request)
    {
    	return Excel::download(new EnquiryExport($request), 'EnquiryReport.xlsx');
    }
}
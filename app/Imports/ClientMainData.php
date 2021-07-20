<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Client;

class ClientMainData implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {

        if(is_numeric($row['created_date']))
        {
            $dateChecker = intval($row['created_date']);
            $checkDate=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateChecker)->format('Y-m-d');
            $checkDate=$checkDate." 00:00:00";
        }
        else
        {
            $checkDate=$row['created_date'];
        }
        $checkMobile=Client::where('mobile_no',$row['mobile_no'])->first();
        if($checkMobile === null)
        {
	        $add=new Client;
	    	$add->auth_id=3;
	    	$add->customer_no=$row['customer_no'];
	    	$add->company=$row['company'];
	    	$add->customer_name=$row['name'];
	    	$add->address=null;
	    	$add->city=$row['city'];
	    	$add->state=$row['state'];
	    	$add->mobile_no=$row['mobile_no'];
	    	$add->alt_mobile_no=null;
	    	$add->created_at=$checkDate;
	    	$add->save();

	    	return $add;
        }

    }
}

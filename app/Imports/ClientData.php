<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Client;
class ClientData implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        
        if(is_numeric($row['created_at']))
        {
            $dateChecker = intval($row['created_at']);
            $checkDate=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateChecker)->format('Y-m-d'); 
        }
        else
        {
            $checkDate=date('Y-m-d',strtotime($row['created_at']));
        }
        // $checkClient=Client::where('mobile_no',$row['mobile_no'])->first();
        // if($checkClient === null)
        // {    
            $last_client=Client::orderBy('id','desc')->first();
            if($last_client)
            {
                $getLast=$last_client->customer_no;
                $getNumber=ltrim($getLast,"FZEE");
                if(intval($getNumber) <= 10)
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

            $add=new Client;
            $add->auth_id=\Auth::user()->id;
            $add->customer_no=$customer_no;
            $add->company=$row['company'];
            $add->customer_name=$row['customer_name'];
            $add->address=$row['address'];
            $add->city=$row['city'];
            $add->state=$row['state'];
            $add->mobile_no=strval($row['mobile_no']);
            $add->alt_mobile_no=$row['alt_mobile_no'];
            $add->created_at=$checkDate." 00:00:00";
            $add->save();
            return $add;
        // }
    }
    public function dateColumns(): array
    {
        return ['expiry_date' => ‘d-m-Y’];
    }
}

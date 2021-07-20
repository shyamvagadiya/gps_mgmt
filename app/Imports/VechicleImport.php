<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Client;
use App\Company;
use App\Type;
use App\Application;
use App\Vehicle;


class VechicleImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
     public function model(array $row)
    {
        //dd($row);

        if(is_numeric($row['expiry_date']))
        {
            $dateChecker = intval($row['expiry_date']);
            $checkDate=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateChecker)->format('Y-m-d');
        }
        else
        {
            $checkDate=date('Y-m-d',strtotime($row['expiry_date']));
        }


        if(is_numeric($row['warranty']))
        {
            $warranty = intval($row['warranty']);
            $warranty=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($warranty)->format('Y-m-d');
        }
        else
        {
            $warranty=date('Y-m-d',strtotime($row['warranty']));
        }
        //dd($checl);
        $type=Type::where('name',$row['type'])->first();
        if($type)
        {
            $type=$type->id;
        }
        else
        {
            $type=0;
        }
        $application=Application::where('name',$row['application'])->first();
        if($application)
        {
            $application=$application->id;
        }
        else
        {
            $application=0;
        }
        $last_client=Client::where('mobile_no',$row['mobile_no'])->first();
        if($last_client)
        {
          $client_id=$last_client->id;  
        }   
        else
        {
            $client_id=0;
        } 
        if($row['vehicle_status'] == 'Active' || $row['vehicle_status'] == 'Inactive')
        {

        }
        else
        {
            if($row['vehicle_status'] == 'ACTIVE' || $row['vehicle_status'] == 'active')
            {
                $row['vehicle_status']="Active";  
            }
            else if($row['vehicle_status'] == 'INACTIVE' || $row['vehicle_status'] == 'inactive')
            {
                $row['vehicle_status']="Inactive";  
            }   
            else
            {
                $row['vehicle_status']="Inactive";      
            }
            
        }

        $payment_details=$row['payment_details'];

        $created_at = intval($row['created_date']);
        $created_at=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($created_at)->format('Y-m-d');
        $created_at=$row['created_date'];

        
        $addnew = new Vehicle();
        $addnew->auth_id=3;
        $addnew->client_id= $client_id;
        $addnew->type_id=$type;
        $addnew->user_id=$row['user_id'];
        $addnew->application_id=$application;
        $addnew->vehicle_no=$row['vehicle_no'];
        $addnew->device_type=$row['device_type'];
        $addnew->imei_no=$row['imei_no'];
        $addnew->sim_no=$row['sim_no'];
        $addnew->warranty=$warranty;
        $addnew->expiry_date=$checkDate;
        $addnew->vehicle_status=$row['vehicle_status'];
        $addnew->salesman=$row['salesman'];
        $addnew->payment_details=$payment_details;
        $addnew->dealer=$row['dealer_name'];
        $addnew->sim_operator="Vodafone";
        $addnew->monthly_sim_charge=29.5;
        $addnew->created_at=$created_at;
        $addnew->save();
        return $addnew;
    
        
        
    }
    public function dateColumns(): array
    {
        return ['expiry_date' => ‘d-m-Y’];
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Client;

class BlankClientExport implements FromCollection,WithHeadings,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Client::where('id',null)->get();
    }

    public function headings(): array
    {
        return [
        	"Mobile No",
        	"Type",
        	"User ID",
        	"Application",
        	"Vehicle No",
        	"Device Type",
        	"IMEI No",
        	"SIM No",
        	"SIM Operator",
        	'Monthly SIM Charge',
        	'Expiry Date',
        	'Warranty',
        	'Vehicle Status',
        	'Salesman',
        	'Technician',
        	'Prepared By',
            'Dealer Name',
            'Created At'
        	
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true)->setSize(14);
            },
        ];
    }
}

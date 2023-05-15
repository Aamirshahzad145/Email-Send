<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class StudentExport implements WithHeadings, FromCollection
{
        public function collection()
    {

        $studentdata =  DB::table('students') 
            ->select('name', 'email', 'username', 'phone', 'dob') ->get();

            $collectionA= $studentdata;
            return $collectionA;
        
    }


    public function headings(): array
    {

        return

            ["Name", "Email", "Username", "Phone", "DOB" ];
    }

    public function map($collectionA): array
    {


        return [
            $collectionA->name,
            $collectionA->email,
            $collectionA->username,
            $collectionA->phone,
            $collectionA->dob,
            
        ];
    }
}

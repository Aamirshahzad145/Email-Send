<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data= Student::select('name', 'email', 'username', 'phone', 'dob')->get();
        dd($data);
    }

    public function headings(): array
    {
        return ["Name", "Email", "Username", "Phone", "DOB"];
    }
}

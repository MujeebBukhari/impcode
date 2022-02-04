<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Excel;
use App\Exports\EmployeeExport;
class EmployeeController extends Controller
{
    public function addEmployees()
    {
        $employee = [
            ["name"=>"Mujeeb", "email"=>"mujeeb@gmail.com", "phone"=>"03041791656", "salary"=>"35000", "department"=>"Accounting"],
            ["name"=>"Hassan", "email"=>"hassan@gmail.com", "phone"=>"03041712930", "salary"=>"3000", "department"=>"Programming"],
            ["name"=>"Syed", "email"=>"syed@gmail.com", "phone"=>"03048973891", "salary"=>"350000", "department"=>"Marketing"],
            ["name"=>"Kashif", "email"=>"kashif@gmail.com", "phone"=>"03041791655", "salary"=>"5000", "department"=>"Quality Assurance"],
            ["name"=>"Ali", "email"=>"ali@gmail.com", "phone"=>"03041723456", "salary"=>"10000", "department"=>"Accounting"],
        ];

        Employee::insert($employee);
        return "Records are inserted";
    }

    public function exportIntoExcel(){
        return Excel::download(new EmployeeExport, 'employeelist.xlsx');
    }
    public function exportIntoCSV()
    {
        return Excel::download(new EmployeeExport, 'employeelist.csv');
    }
}

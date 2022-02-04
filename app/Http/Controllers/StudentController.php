<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('id', 'DESC')->get();
        return view('students', get_defined_vars());
    }
    public function addStudent(Request $request)
    {
        $student = new Student();
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        Alert::success('Success Title', 'Success Message');
        return response()->json($student);
       

    }

    public function getStudentById($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    public function updateStudent(Request $request)
    {
        $student = Student::find($request->id);
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return response()->json($student);

    }

    public function deleteStudents($id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json(['success'=> 'Record has been deleted Successfully']);
    }
}

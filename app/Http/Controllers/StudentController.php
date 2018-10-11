<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function show(Request $request)
    {
        $select = ['id', 'name', 'idPersonal', 'attendant', 'status'];

        if ($request->status){
            $students = Student::where('status', $request->status)->select($select)->get();
        }else{
            $students  = Student::select($select);
        }

        $actions = 'students.datatables.actions';
        $status = 'students.datatables.status';

        return DataTables::of($students)
            ->addColumn('actions', $actions)
            ->addColumn('status_formatted', $status)
            ->rawColumns(['actions', 'status_formatted'])
            ->make(true);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
            [
                'email' => 'required|unique:students',
                'idPersonal' => 'required|unique:students',
            ]);

        $error_array = array();
        $success_output = '';

        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            $student = Student::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'idPersonal' => $request->input('idPersonal'),
                'attendant' => $request->input('attendant'),
                'phone' => $request->input('phone')
            ]);

            $success_output = __(sprintf("Se agrego exitosamente el estudiante: %s", $student->name));
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }
}

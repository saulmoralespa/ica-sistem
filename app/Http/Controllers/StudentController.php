<?php

namespace App\Http\Controllers;

use App\Student;
use function foo\func;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', compact('student'));
    }

    public function show(Request $request)
    {
        $select = ['id', 'name', 'idPersonal', 'attendant', 'peace_save','status'];

        if ($request->status){
            $students = Student::where('status', $request->status)->select($select)->get();
        }else{
            $students  = Student::select($select);
        }

        $actions = 'students.datatables.actions';
        $peaceSave = 'students.datatables.peaceSave';
        $status = 'status.datatables.students.index';

        return DataTables::of($students)
            ->addColumn('actions', $actions)
            ->addColumn('peaceSave', $peaceSave)
            ->addColumn('status_formatted', $status)
            ->rawColumns(['actions', 'status_formatted'])
            ->make(true);
    }


    public function view($id)
    {
        $student = Student::where('idPersonal','=', $id)
                   ->firstOrFail();

        $student->load([
            'contracts'
        ])->get();

        return  view('partials.students.view',compact('student'));
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

    public function get(Request $request)
    {
        $student = Student::find($request->id);


        $contracts = '';
        if ($student->contracts){
            $contracts = $student->contracts;
        }

        return response()->json([
            'name' => $student->name,
            'email' => $student->email,
            'idPersonal' => $student->idPersonal,
            'attendant' => $student->attendant,
            'phone' => $student->phone,
            'contracts' => $contracts
        ]);
    }

    public function update(Request $request)
    {
        $error_array = array();
        $success_output = '';

        $checkEmailExist = Student::where('email', '=', $request->email)->where('id', '!=', $request->id)->first();
        $checkIdPersonalExist = Student::where('idPersonal', '=', $request->idPersonal)->where('id', '!=', $request->id)->first();

        if ($checkEmailExist)
        {
            $error_array[] = __('El correo electrónico ya esta en uso por otro usuario');
        }else if ($checkIdPersonalExist){
            $error_array[] = __('El ID personal ya esta en uso por otro usuario');
        }else{
           $student = Student::find($request->id);
           $student->name = $request->name;
           $student->email = $request->email;
           $student->idPersonal = $request->idPersonal;
           $student->attendant = $request->attendant;
           $student->phone = $request->phone;
           $student->save();
           $success_output = sprintf(__("Se actualizo exitosamente el estudiante: %s"), $student->name);
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function list()
    {
        $students = Student::select('id', 'name')->get();
        return response()->json($students);
    }
}

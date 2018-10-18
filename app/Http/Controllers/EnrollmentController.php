<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enrollment;
use Yajra\DataTables\DataTables;

class EnrollmentController extends Controller
{
    public function fetch()
    {

        $enrollments = Enrollment::select('id','grade', 'bachelor', 'cost');
        $actions = 'actions.datatables.viewdel';

        return DataTables::of($enrollments)
            ->addColumn('actions', $actions)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function delete(Request $request)
    {
        Enrollment::find($request->id)->delete();
    }

    public function add(Request $request)
    {
        $error_array = array();
        $success_output = '';

        if ($this->_checkRegister($request)){
            $error_array[] = __("Ya existe un registro de grado y bachiller idéntico");
        }else{
            Enrollment::create([
                'grade' => $request->grade,
                'bachelor' => $request->bachelor,
                'cost' => $request->cost
            ]);

            $success_output = __("Se ha creado exitosamente la matrícula");
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function get(Request $request)
    {
        $enrollment = Enrollment::find($request->id);
        return response()->json([
            'grade' => $enrollment->grade,
            'bachelor' => $enrollment->bachelor,
            'cost' => $enrollment->cost
        ]);
    }

    public function update(Request $request)
    {
        $error_array = array();
        $success_output = '';

        if ($this->_checkRegister($request, true)){
            $error_array[] = __("Ya existe un registro de grado y bachiller idéntico");
        }else{
            $enrollment = Enrollment::find($request->id);
            $enrollment->grade = $request->grade;
            $enrollment->bachelor = $request->bachelor;
            $enrollment->cost = $request->cost;
            $enrollment->save();
            $success_output = __("Se ha actualizado la matrícula");
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);

    }

    public function _checkRegister($request, $edit = false)
    {
        if ($edit){
            return Enrollment::where('grade', $request->grade)->where('id', '!=', $request->id)->where('bachelor', $request->bachelor)->first();
        }else{
            return Enrollment::where('grade', $request->grade)->where('bachelor', $request->bachelor)->first();
        }
    }
}

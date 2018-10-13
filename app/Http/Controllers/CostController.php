<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CostController extends Controller
{
    public function enrollmentsShow()
    {
        return view('costs.enrollments.index');
    }

    public function enrollmentsFetch()
    {

        $enrollments = Enrollment::select('id','grade', 'bachelor', 'cost');
        $actions = 'actions.datatables.viewdel';

        return DataTables::of($enrollments)
            ->addColumn('actions', $actions)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function enrollmentsDelete(Request $request)
    {
        Enrollment::find($request->id)->delete();
    }

    public function enrollmentsAdd(Request $request)
    {
        $error_array = array();
        $success_output = '';

        $exists = Enrollment::where('grade', $request->grade)->where('bachelor', $request->bachelor)->first();

        if ($exists){
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

    public function enrollmentsUpdate()
    {
    }
}

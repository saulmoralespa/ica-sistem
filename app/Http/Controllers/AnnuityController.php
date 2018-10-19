<?php

namespace App\Http\Controllers;

use App\Annuity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class AnnuityController extends Controller
{
    public function fetch()
    {
        $enrollments = Annuity::select('id', 'year', 'cost', 'discount',
            'maximum_data', 'second_month');
        $actions = 'actions.datatables.viewdel';

        return DataTables::of($enrollments)
            ->addColumn('actions', $actions)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
            [
                'year' => 'required|unique:annuities'
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
            $annuity = Annuity::create([
                'year' => $request->year,
                'cost' => $request->cost,
                'discount' => $request->discount,
                'maximum_data' => Carbon::parse($request->maximum_data),
                'second_month' => $request->second_month
            ]);

            $success_output = __("Se ha creado exitosamente la anualidad");
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function update(Request $request)
    {
    }
}

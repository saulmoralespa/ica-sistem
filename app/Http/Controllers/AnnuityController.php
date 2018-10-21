<?php

namespace App\Http\Controllers;

use App\Annuity;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class AnnuityController extends Controller
{
    public function fetch()
    {
        $enrollments = Annuity::select('id', 'year', 'cost', 'discount',
            'maximum_date', 'second_month');

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
            $maximum_date = Carbon::createFromFormat('d/m/y', $request->maximum_date);
            $second_month = Carbon::createFromFormat('d/m/y', $request->second_month);
            $annuity = Annuity::create([
                'year' => $request->year,
                'cost' => $request->cost,
                'discount' => $request->discount,
                'maximum_date' => $maximum_date,
                'second_month' => $second_month
            ]);

            $success_output = __("Se ha creado exitosamente la anualidad");
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function get(Request $request)
    {
        $annuity = Annuity::find($request->id);
        $annuity->setTransDate(true);
        return response()->json([
            'year' => $annuity->year,
            'cost' => $annuity->cost,
            'discount' => $annuity->discount,
            'maximum_date' => $annuity->maximum_date,
            'second_month' => $annuity->second_month
        ]);
    }

    public function update(Request $request)
    {
        $error_array = array();
        $success_output = '';

        $checkYearExist = Annuity::where('year', '=', $request->year)->where('id', '!=', $request->id)->first();

        if ($checkYearExist){
            $error_array[] = __("El año que esta tratando de ingresar ya ha sido registrado");
        }else{
            $annuity = Annuity::find($request->id);
            $annuity->year = $request->year;
            $annuity->cost = $request->cost;
            $annuity->discount =$request->discount;
            $annuity->maximum_date = Carbon::createFromFormat('d/m/y', $request->maximum_date);
            $annuity->second_month = $request->second_month;
            $annuity->save();

            $success_output = __("Se actualizo exitosamente la anualidad");
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function delete(Request $request){
        Annuity::find($request->id)->delete();
    }
}

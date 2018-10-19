<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class ServiceController extends Controller
{
    public function fetch()
    {
        $services = Service::select('id','name', 'cost', 'status');

        $actions = $actions = 'actions.datatables.viewdel';
        $status = 'status.datatables.services.index';

        return DataTables::of($services)
            ->addColumn('actions', $actions)
            ->addColumn('status_formatted', $status)
            ->rawColumns(['actions', 'status_formatted'])
            ->make(true);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
            [
                'name' => 'required|unique:services'
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
            $service = Service::create([
                'name' => $request->name,
                'cost' => $request->cost,
                'status' => $request->status
            ]);

            $success_output = __(sprintf("Se agrego exitosamente el servicio: %s", $service->name));
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function get(Request $request)
    {
        $service = Service::find($request->id);
        return response()->json([
            'name' => $service->name,
            'cost' => $service->cost,
            'status' => $service->status
        ]);
    }

    public function update(Request $request)
    {

        $error_array = array();
        $success_output = '';

        $checkNameExist = Service::where('name', '=', $request->name)->where('id', '!=', $request->id)->first();

        if ($checkNameExist){
            $error_array[] = __('El nombre de servicio ya esta asignado');
        }else{
            $service  = Service::find($request->id);
            $service->name = $request->name;
            $service->cost = $request->cost;
            $service->status = $request->status;
            $service->save();
            $success_output = __("Se ha actualizado el servicio");
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function delete(Request $request)
    {
        Service::find($request->id)->delete();
        return;
    }

}

<?php

namespace App\Http\Controllers;

use App\Annuity;
use App\Contract;
use App\Enrollment;
use App\Fee;
use App\Service;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ContractController extends Controller
{
    public function dataCreateContract(Request $request)
    {
        $services = Service::where('status', '=', \App\Service::REQUIRED)->select('name', 'cost')->get();
        $enrollment = Enrollment::where('id', '=', $request->id)->select('cost')->get();

        $month = date("n");
        $year = date('Y');

        if ($month >= 9){
            $year++;
        }

        $annuity = Annuity::where('year', '=', $year)->select('cost', 'discount')->get();


        return response()->json([
                'services' => $services,
                'enrollmentCost' => $enrollment[0]['cost'],
                'annuity' => [
                    'cost' => $annuity[0]['cost'],
                    'discount' => $annuity[0]['discount'],
                ],
                'year' => $year
            ]
        );

    }

    public function create(Request $request)
    {

        $checkContractExist = Contract::where('year', '=', $request->year)->where('student_id', '=', $request->id)->first();

        $error_array = array();
        $success_output = '';

        if ($checkContractExist){
            $error_array[] = __("El contrato ya ha sido creado para el estudiante");
        }else{
            $serviceName = $request->serviceName;
            $serviceCost = $request->serviceCost;

            $services = [];

            for ($i=0; $i < count($serviceName); $i++){
                $services[] = array('name' => $serviceName[$i], 'cost' => $serviceCost[$i]);
            }

            $contract = Contract::create([
                'name' => $request->name,
                'year' => $request->year,
                'enrollment_cost' => $request->enrollmentCost,
                'services' => json_encode($services),
                'student_id' => $request->id,
                'observations' => $request->observations,
                'user_id' => Auth::id()
            ]);


            $costFee = bcdiv(2990 / 11, '1', 2);

            $fees = [
                array('name' => __("Cuota 1"), 'price' => $costFee),
                array('name' => __("Cuota 2"), 'price' => $costFee),
                array('name' => __("Cuota 3"), 'price' => $costFee),
                array('name' => __("Cuota 4"), 'price' => $costFee),
                array('name' => __("Cuota 5"), 'price' => $costFee),
                array('name' => __("Cuota 6"), 'price' => $costFee),
                array('name' => __("Cuota 7"), 'price' => $costFee),
                array('name' => __("Cuota 8"), 'price' => $costFee),
                array('name' => __("Cuota 9"), 'price' => $costFee),
                array('name' => __("Cuota 10"), 'price' => $costFee),
                array('name' => __("Cuota 11"), 'price' => $costFee),
            ];

            $fees = Fee::create([
                'contract_id' => $contract->id,
                'fees' => json_encode($fees)
            ]);

            $success_output = __("Se ha creado exitosamente el contracto");
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);

    }

    public function show(Request $request)
    {

        $student = Student::find($request->id);

        if ($request->year != ''){
            $contract = $student->contracts()->where('year', $request->year)->get()->first();
        }else{
            $contract = $student->contracts()->get()->last();
        }

        $user = User::find($contract->user_id);

        return response()->json([
            'id' => $contract->id,
            'name' => $contract->name,
            'enrollment_cost' => $contract->enrollment_cost,
            'services' => json_decode($contract->services),
            'username' => $user->username,
            'date_created' => $contract->created_at->format('d/m/y g:i a'),
            'fees' => json_decode($contract->fee->fees)
        ]);

    }


    public function test(Request $request)
    {
        $contract = Contract::find(1);
        $user = User::find($contract->user_id);
        /*return response()->json([
            'enrollment_cost' => $contract->enrollment_cost,
            'services' => json_decode($contract->services),
            'fees' => json_decode($contract->fees->fees),
            'user_id' => $user->name
        ]);*/


        if (empty($request->has('id'))){
            echo 'Hello';
        }else{
            echo 'nada';
        }

        $student = Student::find(1);

        $contract = $student->contracts()->get()->last();


        dd($contract->user_id);

    }

}

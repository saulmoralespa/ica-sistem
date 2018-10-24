<?php

namespace App\Http\Controllers;

use App\Annuity;
use App\Contract;
use App\Enrollment;
use App\Fee;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                ]
            ]
        );

    }

    public function create(Request $request)
    {

        $serviceName = $request->serviceName;
        $serviceCost = $request->serviceCost;

        $services = [];

        for ($i=0; $i < count($serviceName); $i++){
            $services[] = array('name' => $serviceName[$i], 'cost' => $serviceCost[$i]);
        }

        $contract = Contract::create([
            'enrollment_cost' => $request->enrollmentCost,
            'services' => json_encode($services),
            'student_id' => $request->id,
            'observations' => $request->observations,
            'user_id' => Auth::id()
        ]);


        $costFee = bcdiv(2990 / 11, '1', 2);

        $fees = [
            $costFee,
            $costFee,
            $costFee,
            $costFee,
            $costFee,
            $costFee,
            $costFee,
            $costFee,
            $costFee,
            $costFee,
            $costFee
        ];

        $fees = Fee::create([
            'contract_id' => $contract->id,
            'fees' => json_encode($fees)
        ]);

    }

    public function determineYearAnnuite()
    {
        $today = date("n");

    }

    public function test()
    {
        $services = Service::where('status', '=', \App\Service::REQUIRED)->select('name', 'cost')->get();

        $array = array(array('name' => 'nuevo', 'price' => 45), array('name' => 'die', 'price' => 20.30));


        $names = ['patricio', 'Luis'];

        var_dump($names);

        $NewArray = [];

        for ($i=0; $i < count($names); $i++){
            $NewArray[] = array('name' => $names[$i]);
        }

        var_dump($NewArray);
    }

}

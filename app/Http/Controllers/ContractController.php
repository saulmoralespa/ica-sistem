<?php

namespace App\Http\Controllers;

use App\Annuity;
use App\Contract;
use App\Enrollment;
use App\Payment;
use App\Service;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function dataCreateContract(Request $request)
    {
        $services = Service::where('status', '=', \App\Service::REQUIRED)->select('name', 'cost')->get();
        $enrollment = Enrollment::where('id', '=', $request->id)->select('cost')->get()->first();

        $month = date("n");
        $year = date('Y');

        if ($month >= 9){
            $year++;
        }

        $annuity = Annuity::where('year', '=', $year)->select('cost', 'discount', 'maximum_date')->get()->first();

        $today = date("d-m-y");
        $dateget = date("d-m-y", strtotime($annuity->maximum_date));


        return response()->json([
                'services' => $services,
                'enrollmentCost' => $enrollment->cost,
                'annuity' => [
                    'cost' => $annuity->cost,
                    'discount' => $annuity->discount,
                    'discount_edit' => ($today < $dateget) ? false : true
                ],
                'year' => $year
            ]
        );

    }

    public function create(Request $request)
    {

        $student = Student::find($request->id);
        $checkContractExist = $student->contracts()->where('year', '=', $request->year)->first();

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

            $data = [
                'name' => $request->name,
                'year' => $request->year,
                'enrollment_cost' => $request->enrollmentCost,
                'services' => $services,
                'student_id' => $student->id,
                'observations' => $request->observations,
                'user_id' => Auth::id()
            ];

            $contract = $student->contracts()->create($data);

            $price = $request->totalAnnuity  / 11;

            $costFee = (float)number_format((float)$price,2,".",".");

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

            $data = [
                'contract_id' => $contract->id,
                'fees' => $fees
            ];

            $contract->fee()->create($data);
            $student->peace_save = Student::INACTIVE;
            $student->status = Student::ACTIVE;
            $student->save();

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

        //verif if student have a contract

        $student = Student::find($request->id);

        if ($request->year != ''){
            $contract = $student->contracts()->where('year', $request->year)->get()->first();
        }else{
            $contract = $student->contracts()->get()->last();
        }


        $data = [];

        if (isset($contract)){
            $years = $student->contracts()->select('year')->orderBy('year', 'desc')->get();
            $user = User::find($contract->user_id);
            $data = [
                'id' => $contract->id,
                'name' => $contract->name,
                'enrollment_cost' => $contract->enrollment_cost,
                'services' => $contract->services,
                'observations' => $contract->observations,
                'fees' => $contract->fee->fees,
                'years' => $years,
                'username' => $user->username,
                'date_created' => $contract->created_at->format('d/m/y g:i a'),
            ];
        }

        return response()->json($data);

    }

    public function delete(Request $request)
    {
        $student = Student::find($request->idstudent);
        $contract = $student->contracts()->find($request->idContract);
        $contract->fee()->delete();
        $contract->delete();
        $student->peace_save = Student::DISCOUNTINUED;
        $student->status = Student::INACTIVE;
        $student->save();
        return;
    }
}

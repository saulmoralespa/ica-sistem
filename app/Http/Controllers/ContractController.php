<?php

namespace App\Http\Controllers;

use App\Annuity;
use App\Enrollment;
use App\Service;
use Illuminate\Http\Request;
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



    public function determineYearAnnuite()
    {
        $today = date("n");

    }


}

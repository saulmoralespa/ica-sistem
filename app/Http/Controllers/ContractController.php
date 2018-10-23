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
        $enrollment = Enrollment::where('id', '=', 1)->select('cost');
        $annuity = Annuity::where('id', '=', 1)->select('cost', 'discount');

        return response()->json([

        ]);

        /* */
    }
}

<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CostController extends Controller
{
    public function enrollments()
    {
        return view('costs.enrollments.index');
    }

    public function fetch()
    {

        $enrollments = Enrollment::select('id','grade', 'bachelor', 'cost');
        $actions = 'actions.datatables.viewdel';

        return DataTables::of($enrollments)
            ->addColumn('actions', $actions)
            ->rawColumns(['actions'])
            ->make(true);
    }
}

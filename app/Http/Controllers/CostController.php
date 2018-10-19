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

    public function services()
    {
        return view('costs.services.index');
    }
}

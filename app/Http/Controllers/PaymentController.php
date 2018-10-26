<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show()
    {
        return view('payments.index');
    }
}

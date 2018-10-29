<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function show()
    {
        return view('payments.index');
    }

    public function fetch(Request $request)
    {

        $actions = 'payments.datatables.actions';

        $payments = Payment::with('student')
            ->whereHas('student', function ($q) {
            })->select('id','date_deposit', 'student_id', 'receipt', 'amount', 'created_at');

        return Datatables::of($payments)
            ->editColumn('created_at', function ($payment) {
                return [
                    'display' => e(
                        $payment->created_at->format('m/d/y g:i a')
                    )
                ];
            })
            ->addColumn('student', function ($payment){
                return $payment->student->name;
            })
            ->addColumn('attendant', function ($payment){
                return $payment->student->attendant;
            })
            ->addColumn('actions', $actions)
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function add()
    {
        return view('partials.payments.index');
    }

    public function test(Request $request)
    {
        $student = Student::find(1);

        $contract = $student->contracts()->get()->last();

        if(isset($contract))
            dd($contract);
    }
}

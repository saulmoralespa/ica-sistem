<?php

namespace App\Http\Controllers;

use App\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function update(Request $request)
    {
        $fee = Fee::find($request->id);
        $fee->fees = json_decode($request->fees);
        $fee->save();
    }
}

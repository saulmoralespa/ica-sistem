<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function show()
    {
        $users = User::query();
        $actions = 'users.datatables.actions';
        return DataTables::of($users)->addColumn('actions', $actions)->rawColumns(['actions'])->make(true);
    }

    public function delete(Request $request)
    {
        User::find($request->id)->delete();
        return response()->json();
    }

    public function edit()
    {
        return 'hello';
    }
}

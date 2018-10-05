<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::pluck('name','name')->all();
        $permission = Permission::get();
        return view('users.index', compact('roles', 'permission'));
    }

    public function show()
    {

        $users = User::select(['id', 'name', 'username', 'email', 'created_at'])->where('id', '!=', \Auth::user()->id);

        $actions = 'users.datatables.actions';

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                return [
                    'display' => e(
                        $user->created_at->format('m/d/Y')
                    ),
                    'timestamp' => $user->created_at->timestamp
                ];
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%m/%d/%Y') LIKE ?", ["%$keyword%"]);
            })
            ->addColumn('actions', $actions)
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function delete(Request $request)
    {
        User::find($request->id)->delete();
        return response()->json();
    }

    public function fetch(Request $request)
    {
        $userid = $request->id;
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$userid )
            ->get();

        $user = User::find($request->id);
        return response()->json([
            'name' => $user->name,
            'role_id' => isset($user->roles->first()->id) ? $user->roles->first()->id : '',
            'username' => $user->username,
            'email' => $user->email,
            'permissions' => isset($rolePermissions) ? $rolePermissions : ''
        ]);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        $error_array = array();
        $success_output = '';

        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            $user = User::find($request->id);
            $username = $user->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $this->_assinRoleAndPermissions($request, $user);
            if (!empty($request->password))
                $user->password = bcrypt($request->password);
            $user->save();

            $success_output = __(sprintf("Se actualizo exitosamente el usuario: %s", $username));
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    public function add(Request $request)
    {
        $validation = Validator::make($request->all(),
            [
                'email' => 'required|unique:user|email',
                'username' => 'required|string|unique:users',
            ]);


        return response()->json( $validation);

        $error_array = array();
        $success_output = '';

        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))

            ]);

            $this->_assinRoleAndPermissions($request, $user, true);
            $success_output = __(sprintf("Se agrego exitosamente el usuario: %s", $user->username));
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return response()->json($output);
    }

    private function _assinRoleAndPermissions($request, $user, $createUser = false)
    {
        $permissions = Permission::all();

        if ((!empty($request->role_id) && $request->role_id == 1) || (count($request->permission) === count($permissions))){
            if ($createUser)
                $user->assignRole('SuperAdministrator');
            $user->syncRoles(['SuperAdministrator']);
            $role = Role::find($user->id);
            $role->syncPermissions($permissions);
        }
        if (!empty($request->role_id) && $request->role_id == 2 && count($request->permission) < count($permissions)){
            if ($createUser)
                $user->assignRole('Administrator');
            $user->syncRoles(['Administrator']);
            $role = Role::find($user->id);
            $role->syncPermissions($request->permission);
        }
    }
}

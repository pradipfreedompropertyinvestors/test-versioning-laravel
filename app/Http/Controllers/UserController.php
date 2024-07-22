<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.id', '!=', Auth::user()->id)
                ->orderByDesc('users.created_at')
                ->select(['users.id', 'users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.mobile_number', 'users.gender', 'users.status', 'roles.name', 'users.created_at', 'users.updated_at']);

                // Filter by status if provided in the request
                if ($request->has('status') && $request->status != '') {
                    $data->where('users.status', $request->status);
                }

                // Filter by role_id if provided in the request
                if ($request->has('role_id') && $request->role_id != '') {
                    $data->where('roles.id', $request->role_id);
                }
            
            return DataTables::of($data)
                ->addColumn('actions', function($row) {
                    $editUrl = route('users.edit', ['user' => $row->id]);
                    $btn = '<a href="javascript:void(0);" class="edit" title="Edit" data-id="' . $row->id . '" data-edit-url="' . $editUrl . '"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0);" class="delete" title="Delete" data-id="' . $row->id . '"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->blacklist(['password', 'remember_token']) // Blacklist columns
                ->make(true);
        }
        $roles = Role::all();
        return view('users.index', compact('roles'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(StoreUserRequest $request) {
        $user = new User([
            'role_id' => $request->role_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'mobile_number' => $request->mobile_number,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        //$user->roles()->attach($request->role_id);
        $user->save();

        return response()->json(['success' => 'User created successfully'], 200);
    }

    // Method to fetch user details for editing
    public function edit($id) {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, User $user) {
        $data = $request->validated();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return response()->json(['success' => 'User updated successfully.']);
    }

    public function destroy(User $user) {
        $user->delete();
        return response()->json(['success' => 'User deleted successfully'], 200);
    }

    public function export(Request $request) {
        ini_set('memory_limit', '512M');
        $export = new UsersExport($request);
        $fileName = 'users.csv';
        return Excel::download($export, $fileName);
    }
}

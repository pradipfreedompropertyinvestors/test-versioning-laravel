<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Role::orderBy('id')
                ->select(['id', 'name', 'status', 'created_at', 'updated_at']);
            return DataTables::of($data)
                ->addColumn('actions', function($row) {
                    // Add your actions here if needed
                    $editUrl = route('roles.edit', ['role' => $row->id]);
                    $btn = '<a href="javascript:void(0);" class="edit" title="Edit" data-id="' . $row->id . '" data-edit-url="' . $editUrl . '"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0);" class="delete" title="Delete" data-id="' . $row->id . '"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request) {
        Role::create($request->all());
        return response()->json(['success' => 'Role created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role) {
        $role->update($request->all());
        return response()->json(['success' => 'Role updated successfully.']);
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) {
        $role->delete();
        return response()->json(['success' => 'Role deleted successfully'], 200);
    }
}

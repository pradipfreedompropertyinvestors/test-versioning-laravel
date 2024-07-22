<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreStateRequest;

class StateController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = State::orderByDesc('created_at')
                ->select(['id', 'state_name', 'state_code', 'status', 'created_at', 'updated_at']);

            // Filter by status if provided in the request
            if ($request->has('status') && $request->status != '') {
                $data->where('status', $request->status);
            }

            return DataTables::of($data)
                ->addColumn('actions', function($row) {
                    // Add your actions here if needed
                    $editUrl = route('states.edit', ['state' => $row->id]);
                    $btn = '<a href="javascript:void(0);" class="edit" title="Edit" data-id="' . $row->id . '" data-edit-url="' . $editUrl . '"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0);" class="delete" title="Delete" data-id="' . $row->id . '"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('states.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStateRequest $request) {
        State::create($request->all());
        return response()->json(['success' => 'State created successfully'], 200);
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
        $state = State::findOrFail($id);
        return response()->json($state);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStateRequest $request, State $state) {
        $state->update($request->all());
        return response()->json(['success' => 'State updated successfully.']);
    }  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state) {
        $state->delete();
        return response()->json(['success' => 'State deleted successfully'], 200);
    }
}

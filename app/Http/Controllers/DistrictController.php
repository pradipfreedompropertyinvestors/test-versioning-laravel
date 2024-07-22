<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreDistrictRequest;

class DistrictController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = District::join('states', 'districts.state_id', '=', 'states.id')
                ->orderByDesc('districts.created_at')
                ->select(['districts.id', 'districts.district_name', 'districts.district_code', 'states.state_name', 'districts.status', 'districts.created_at', 'districts.updated_at']);

            // Filter by status if provided in the request
            if ($request->has('status') && $request->status != '') {
                $data->where('districts.status', $request->status);
            }

            // Filter by state_id if provided in the request
            if ($request->has('state_id') && $request->state_id != '') {
                $data->where('districts.state_id', $request->state_id);
            }

            return DataTables::of($data)
                ->addColumn('actions', function($row) {
                    $editUrl = route('districts.edit', ['district' => $row->id]);
                    $btn = '<a href="javascript:void(0);" class="edit" title="Edit" data-id="' . $row->id . '" data-edit-url="' . $editUrl . '"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0);" class="delete" title="Delete" data-id="' . $row->id . '"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        $states = State::all();
        return view('districts.index', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request) {
        District::create($request->all());
        return response()->json(['success' => 'District created successfully'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $district = District::findOrFail($id);
        return response()->json($district);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDistrictRequest $request, District $district) {
        $district->update($request->all());
        return response()->json(['success' => 'District updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district) {
        $district->delete();
        return response()->json(['success' => 'District deleted successfully'], 200);
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubDistrict;
use App\Models\District;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSubDistrictRequest;

class SubDistrictController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = SubDistrict::join('districts', 'sub_districts.district_id', '=', 'districts.id')
                ->join('states', 'districts.state_id', '=', 'states.id')
                ->orderByDesc('sub_districts.created_at')
                ->select(['sub_districts.id', 'sub_districts.subdistrict_name', 'sub_districts.subdistrict_code', 'districts.district_name', 'states.state_name', 'sub_districts.status', 'sub_districts.created_at', 'sub_districts.updated_at']);

            // Filter by status if provided in the request
            if ($request->has('status') && $request->status != '') {
                $data->where('sub_districts.status', $request->status);
            }

            // Filter by state_id if provided in the request
            if ($request->has('state_id') && $request->state_id != '') {
                $data->where('districts.state_id', $request->state_id);
            }

            // Filter by district_id if provided in the request
            if ($request->has('district_id') && $request->district_id != '') {
                $data->where('sub_districts.district_id', $request->district_id);
            }

            return DataTables::of($data)
                ->addColumn('actions', function($row) {
                    $editUrl = route('subdistricts.edit', ['subdistrict' => $row->id]);
                    $btn = '<a href="javascript:void(0);" class="edit" title="Edit" data-id="' . $row->id . '" data-edit-url="' . $editUrl . '"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0);" class="delete" title="Delete" data-id="' . $row->id . '"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        $states = State::all();
        $districts = District::all();
        return view('subdistricts.index', compact('districts', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubDistrictRequest $request) {
        SubDistrict::create($request->all());
        return response()->json(['success' => 'Sub-district created successfully'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $subDistrict = SubDistrict::findOrFail($id);
        return response()->json($subDistrict);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubDistrictRequest $request, SubDistrict $subDistrict) {
        $subDistrict->update($request->all());
        return response()->json(['success' => 'Sub-district updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubDistrict $subDistrict) {
        $subDistrict->delete();
        return response()->json(['success' => 'Sub-district deleted successfully'], 200);
    }
}
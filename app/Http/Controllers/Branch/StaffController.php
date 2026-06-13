<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\CreateStaffRequest;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'staffs' => auth()->user()->staff->branch->staffs
        ])->setStatusCode(200);
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
    public function store(CreateStaffRequest $request)
    {
        $staff = Staff::query()->create([
            'branch_id' => auth()->user()->staff->branch_id,
            'name' => $request->get('name'),
            'family' => $request->get('family'),
            'mobile' => $request->get('mobile'),
            'personal_code' => random_int(11111,99999),
            'national_code' => $request->get('national_code'),
            'education' => $request->get('education'),
            'role' => $request->get('role'),
            'father_name' => $request->get('father_name'),
            'address' => $request->get('address'),
        ]);

        User::query()->create([
            'user_id' => $staff->id,
            'model' => 'App\Http\Models\Staff',
            'role_id' => $request->get('role_id'),
            'username' => $staff->national_code,
            'password' => Hash::make($staff->mobile)
        ]);

        return response()->json([
            'msg' => 'کارمند با موفقیت افزوده شد'
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        return response()->json([
            'staff' => $staff,
            'role_id' => $staff->user->role_id
        ])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $staff->update([
            'branch_id' => auth()->user()->staff->branch_id,
            'name' => $request->get('name'),
            'family' => $request->get('family'),
            'mobile' => $request->get('mobile'),
            'national_code' => $request->get('national_code'),
            'education' => $request->get('education'),
            'role' => $request->get('role'),
            'father_name' => $request->get('father_name'),
            'address' => $request->get('address'),
        ]);

//        User::query()->create([
//            'user_id' => $staff->id,
//            'model' => 'App\Http\Models\Staff',
//            'role_id' => $request->get('role_id'),
//            'username' => $staff->national_code,
//            'password' => Hash::make($staff->mobile)
//        ]);

        return response()->json([
            'msg' => 'کارمند با موفقیت ویرایش شد'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return response()->json([
            'msg' => 'کارمند با موفقیت حذف شد'
        ])->setStatusCode(200);
    }
}

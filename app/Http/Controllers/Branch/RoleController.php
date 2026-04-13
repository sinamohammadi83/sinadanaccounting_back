<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\CreateRoleRequest;
use App\Http\Resources\Branch\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'roles' => RoleResource::collection(Role::query()->where('branch_id',auth()->user()->staff->branch_id)->get())
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
    public function store(CreateRoleRequest $request)
    {
        $role = Role::query()->create([
            'title' => $request->get('title'),
            'branch_id' => auth()->user()->staff->branch_id
        ]);

        $role->permissions()->attach($request->get('permission'));

        return response()->json([
            'msg' => 'نقش با موفقیت افزوده شد'
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json([
            'role' => new RoleResource($role)
        ])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRoleRequest $request, Role $role)
    {
        $role->update([
            'title' => $request->get('title')
        ]);

        $role->permissions()->sync($request->get('permission'));

        return response()->json([
            'msg' => 'نقش با موفقیت ویرایش شد'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();

        $role->delete();

        return response()->json([
            'msg' => 'نقش با موفقیت حذف شد'
        ])->setStatusCode(200);
    }

    public function get_permissions()
    {
        return response()->json([
            'permissions' => Permission::query()->where('permission','not like','%-admin')->get()
        ])->setStatusCode(200);
    }
}

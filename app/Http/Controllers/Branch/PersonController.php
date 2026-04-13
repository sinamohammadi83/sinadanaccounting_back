<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\PersonRequest;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'persons' => auth()->user()->staff->branch->persons
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
    public function store(PersonRequest $request)
    {
        $request["branch_id"] = auth()->user()->staff->branch_id;

        Person::query()->create($request->toArray());

        return response()->json([
            'msg' => 'شخص با موفقیت ایجاد شد'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return response()->json([
            'person' => $person
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonRequest $request,Person $person)
    {

        $person->update($request->toArray());

        return response()->json([
            'msg' => 'شخص با موفقیت ویرایش شد'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return response()->json([
            'msg' => 'شخص با موفقیت حذف شد'
        ],200);
    }
}

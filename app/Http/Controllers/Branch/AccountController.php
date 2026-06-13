<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'accounts' => auth()->user()->staff->branch->accounts
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
    public function store(Request $request)
    {
        Account::query()->create([
            'branch_id' => auth()->user()->staff->branch_id,
            "name" => $request->get('name'),
            "code" => random_int(1111,9999),
            "type" => $request->get('type'),
        ]);

        return response()->json([
            'msg' => 'حساب با موفیت اضاف شد'
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return response()->json([
            'account' => $account
        ])->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $account->update([
            'branch_id' => auth()->user()->staff->branch_id,
            "name" => $request->get('name'),
            "type" => $request->get('type'),
        ]);

        return response()->json([
            'msg' => 'حساب با موفیت ویرایش شد'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json([
            'msg' => 'حساب با موفیت حذف شد'
        ])->setStatusCode(200);
    }
}

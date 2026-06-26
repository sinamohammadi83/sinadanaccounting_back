<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\NewDocumentRequest;
use App\Models\document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'documents' => auth()->user()->staff->branch->documents
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
    public function store(NewDocumentRequest $request)
    {
        $document = document::query()->create([
            'description' => $request->get('description'),
            'type' => $request->get('type'),
            'status' => $request->get('status'),
        ]);

        $document->documentRows()->create([
            'account_id' => $request->get('account_id'),
            'account_name' => $request->get('account_name'),
            'description' => $request->get('description'),
            'detailed_code' => random_int(1111,9999),
            'debtor' => $request->get('debtor'),
            'creditor' => $request->get('creditor'),
            'due_date' => $request->get('due_date'),
        ]);

        return response()->json([
            'msg' => 'سند با موفیت اضافه شد'
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, document $document)
    {
        $document->update([
            'description' => $request->get('description'),
            'type' => $request->get('type'),
            'status' => $request->get('status'),
        ]);



        return response()->json([
            'msg' => 'سند با موفیت ویرایش شد'
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(document $document)
    {
        $document->documentRows()->delete();

        $document->delete();

        return response()->json([
            'msg' => 'سند با موفیت حذف شد'
        ])->setStatusCode(200);
    }
}

<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\NewDocumentRequest;
use App\Http\Resources\Branch\DocumentResource;
use App\Models\document;
use App\Models\documentRows;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'documents' => DocumentResource::collection(auth()->user()->staff->branch->documents)
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
            'branch_id' => auth()->user()->staff->branch_id,
            'staff_id' => auth()->user()->staff->id,
            'title' => $request->get('title'),
            'type' => $request->get('type'),
            'status' => $request->get('status'),
            'date' => $request->get('date'),
            'due_date' => $request->get('due_date'),
        ]);

        $documents = $request->get('document_rows');

        foreach($documents as $document_row){
            documentRows::query()->create([
                'document_id' => $document->id,
                'account_id' => $document_row['account_id'],
                'account_name' => $document_row['account_name'],
                'account_code' => $document_row['account_code'],
                'description' => $document_row['description'],
                'detailed_code' => random_int(1111,9999),
                'debtor' => $document_row['debtor'],
                'creditor' => $document_row['creditor'],
            ]);
        }

        return response()->json([
            'msg' => 'سند با موفیت اضافه شد'
        ])->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(document $document)
    {
        return response()->json([
            'document' => new DocumentResource($document)
        ])->setStatusCode(200);
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
            'branch_id' => auth()->user()->staff->branch_id,
            'staff_id' => auth()->user()->staff->id,
            'title' => $request->get('title'),
            'type' => $request->get('type'),
            'status' => $request->get('status'),
            'date' => $request->get('date'),
            'due_date' => $request->get('due_date'),
        ]);

        $documents = $request->get('document_rows');

        foreach($documents as $document_row){
            documentRows::query()->where('id',$document_row['document_row_id'])->update([
                'document_id' => $document->id,
                'account_id' => $document_row['account_id'],
                'account_name' => $document_row['account_name'],
                'account_code' => $document_row['account_code'],
                'description' => $document_row['description'],
                'detailed_code' => random_int(1111,9999),
                'debtor' => $document_row['debtor'],
                'creditor' => $document_row['creditor'],
            ]);
        }


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

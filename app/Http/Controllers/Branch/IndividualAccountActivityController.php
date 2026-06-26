<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\document;
use App\Models\Factor;
use App\Models\Person;
use Illuminate\Http\Request;

class IndividualAccountActivityController extends Controller
{
    public function show(Person $person)
    {

        $factors_ids = $person->factors()->pluck('id');

        $documents = document::query()->whereIn('factor_id',$factors_ids)->get();




        return response()->json([
            'factors' => $factors
        ])->setStatusCode(200);
    }
}

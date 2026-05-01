<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\Branch\ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json([
            'user' => new ProfileResource(auth()->user())
        ])->setStatusCode(200);
    }

    public function getPermissions()
    {
        return response()->json([
            'permissions' => auth()->user()->role->permissions
        ])->setStatusCode(200);
    }
}

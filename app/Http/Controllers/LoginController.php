<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function store(LoginRequest $request)
    {
        $user = User::query()
            ->where("username",$request->get("username"))
            ->where("password",hash("sha256",$request->get("password")))
            ->firstOrFail();

        $user->tokens()->delete();

        if($user->model == "App\Http\Models\Admin"){
            return response()->json([
                'token' => $user->createToken("user")->plainTextToken . str(uuid_create())->substr(0,3),
            ])->setStatusCode(200);
        }

        return response()->json([
            'token' => $user->createToken("user")->plainTextToken,
        ])->setStatusCode(200);
    }

    public function check()
    {
        return true;
    }

    public function destroy()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'msg' => 'با موفقیت خارج شدید',
        ])->setStatusCode(200);
    }
}

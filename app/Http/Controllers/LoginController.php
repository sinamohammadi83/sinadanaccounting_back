<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{


    public function store(LoginRequest $request)
    {

        $user = User::query()
            ->where("username",$request->get("username"))
            ->firstOrFail();

        if(!Hash::check($request->get('password'),$user->password))
        {
            abort(404,'No query results for model [App\\Models\\User].');
        }

        $user->tokens()->delete();


        if($user->model == "App\Http\Models\Admin"){
            return response()->json([
                'token' => $user->createToken("user")->plainTextToken . str(uuid_create())->substr(0,3),
            ])->setStatusCode(200);
        }

        $token = $user->createToken("user")->plainTextToken;

        $permissions = $user->getPermissions();


        $user->tokens()->latest()->first()->update([
            'abilities' => $permissions
        ]);

        return response()->json([
            'token' => $token
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

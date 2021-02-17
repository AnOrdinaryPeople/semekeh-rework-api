<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Rules\Recaptcha;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $req){
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha' => ['required', new Recaptcha]
        ]);

        if($u = User::whereEmail($req->email)->first()){
            if($u->is_active){
                if($token = app('auth')->claims(User::getUser($u->role_id))->attempt($req->only('email', 'password')))
                    return response()->json(compact('token'));
                else
                    return response(['message' => __('auth.failed')], 401);
            }else return response(['message' => __('auth.failed')], 401);
        }else return response(['message' => __('auth.failed')], 401);
    }

    public function logout(){
        app('auth')->logout();

        return response()->json(['message' => __('auth.logout')]);
    }

    public function refresh(){
        return $this->respondWithToken(app('auth')->refresh());
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => app('auth')->factory()->getTTL() * 60
        ]);
    }

    public function me(){
        return response()->json(app('auth')->user());
    }

    public function update(Request $req){
        $this->validate($req, [
            'name' => 'required|string',
            'pass' => 'required|string',
            'password' => 'nullable|confirmed'
        ]);

        try {
            DB::beginTransaction();

            if($check = User::find(app('auth')->user()->id)){
                if(Hash::check($req->pass, $check->password)){
                    $check->update([
                        'name' => $req->name,
                        'password' => $req->password
                            ? Hash::make($req->password)
                            : $check->password
                    ]);
    
                    $r = response([
                        'message' => __('label.success.update', [
                            'data' => __('label.profile')
                        ])
                    ]);
                    DB::commit();
                }else{
                    $r = response(['message' => __('auth.failed')], 422);
                    DB::rollback();
                }
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.footer')
                    ])
                ], 422);
                DB::rollback();
            }
        } catch (Exception $e) {
            $r = response(['message' => __('auth.server_error')], 500);
            DB::rollback();
        }

        return $r;
    }
}

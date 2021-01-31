<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Rules\Recaptcha;

class AuthController extends Controller
{
    public function login(Request $req){
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha' => ['required', new Recaptcha]
        ]);

        if($token = app('auth')->attempt($req->only('email', 'password')))
            return response()->json(compact('token'));
        else
            return response(['email' => __('auth.failed')], 401);
    }

    public function update($id, Request $req){
        $this->validate($req, [
            'name' => 'required|string',
            'pass' => 'required|string',
            'password' => 'nullable|confirmed'
        ]);

        try {
            DB::beginTransaction();

            if($check = User::find($id)){
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

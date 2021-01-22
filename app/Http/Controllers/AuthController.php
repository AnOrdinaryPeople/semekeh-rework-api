<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\AuthUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthRequest $req){
        if($req->val && $req->val->fails())
            return response($req->val->errors(), 422);
        else{
            $user = User::where('email', $req->email)->first();

            if(!$user || !Hash::check($req->password, $user->password) || !$user->is_active)
                return response(['email' => __('auth.failed')], 422);
            else{
                return response([
                    'user' => User::getUser($user->id),
                    'token' => $user->createToken('auth-token')->plainTextToken,
                    'access' => Permission::getAccess($user->role_id),
                    'menu' => Menu::getMenu()
                ]);
            }
        }
    }
    public function logout($id){
        try {
            DB::beginTransaction();

            if($check = User::find($id)){
                $check->tokens()->delete();

                $r = response(['status' => true]);
                DB::commit();
            }else{
                $r = response(['error' => __('auth.not_found')], 422);
                DB::rollback();
            }
        } catch (Exception $e) {
            $r = response(['server' => __('auth.server_error')], 500);
            DB::rollback();
        }
        return $r;
    }
    public function getUser(Request $req){
        $a = $req->user();

        return response([
            'user' => User::getuser($a->id),
            'access' => Permission::getAccess($a->id)
        ]);
    }
    public function update(AuthUpdateRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $a = $req->user();

                if($check = User::find($a->id)){
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
        }
        return $r;
    }
}

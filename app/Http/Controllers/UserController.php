<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function table(){
        return response([
            'user' => User::where('users.id', '!=', 1)
                ->join('roles', 'roles.id', '=', 'role_id')
                ->latest('users.created_at')
                ->get(['users.id', 'users.name', 'email', 'is_active', 'roles.name as role', 'role_id']),
            'role' => Role::latest()->pluck('name', 'id')
        ]);
    }
    public function create(UserRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                User::create([
                    'name' => $req->name,
                    'email' => $req->email,
                    'email_verified_at' => now(),
                    'password' => Hash::make($req->password),
                    'role_id' => $req->role_id
                ]);

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.user')
                    ])
                ]);
                DB::commit();
            } catch (Exception $e) {
                $r = response(['message' => __('auth.server_error')], 500);
                DB::rollback();
            }
        }
        return $r;
    }
    public function update($id, UserUpdateRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                if($check = User::find($id)){
                    $check->update([
                        'name' => $req->name,
                        'email' => $req->email,
                        'password' => $req->password
                            ? Hash::make($req->password)
                            : $check->password,
                        'role_id' => $req->role_id
                    ]);

                    $r = response([
                        'message' => __('label.success.update', [
                            'data' => __('label.user')
                        ])
                    ]);
                    DB::commit();
                }else{
                    $r = response([
                        'message' => __('label.error.not_found', [
                            'data' => __('label.user')
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
    public function ban($id){
        try {
            DB::beginTransaction();

            if($check = User::find($id)){
                $check->update(['is_active' => !$check->is_active]);

                $r = response([
                    'message' => __('label.success.publish', [
                        'data' => __('label.user'),
                        'toggle' => __($check->is_active ? 'active' : 'inactive')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.user')
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

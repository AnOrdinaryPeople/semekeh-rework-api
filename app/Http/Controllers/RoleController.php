<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function table(){
        return response(Role::where('id', '!=', 1)->latest()->get());
    }
    public function create(){
        $a = Permission::oldest('id')->get();

        foreach($a as $b) $data[] = [
            'permission' => $b->name,
            'status' => false
        ];

        return response(['perm' => $data]);
    }
    public function edit($id){
        $a = Role::getEdit($id);

        return response([
            'perm' => $a ?? [],
            'name' => Role::find($id)->name
        ]);
    }
    public function store(Request $req){
        try {
            DB::beginTransaction();

            $role = Role::create(['name' => $req->name]);
            Permission::createNew($req->list, $role->id);

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.role')
                ])
            ]);
            DB::commit();
        } catch (Exception $e) {
            $r = response(['message' => __('auth.server_error')], 500);
            DB::rollback();
        }
        return $r;
    }
    public function update($id, Request $req){
        try {
            DB::beginTransaction();

            if($check = Role::find($id)){
                    $check->update(['name' => $req->name]);
                    Permission::updatee($req->list, $check->id);

                    $r = response([
                        'message' => __('label.success.update', [
                            'data' => __('label.role')
                        ])
                    ]);
                    DB::commit();
                }else{
                    $r = response([
                        'message' => __('label.error.not_found', [
                            'data' => __('label.role')
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
    public function delete($id){
        try {
            DB::beginTransaction();

            if($check = Role::find($id)){
                if(User::whereRoleId($check->id)->count() > 0){
                    $r = response(['message' => __('label.error.role_used')], 422);
                    DB::rollback();
                }else{
                    Permission::woosh($check->id);
                    $check->delete();

                    $r = response([
                        'message' => __('label.success.delete', [
                            'data' => __('label.role')
                        ])
                    ]);
                    DB::commit();
                }
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.role')
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    public function table(){
        return response(Social::latest()->get());
    }
    public function create(SocialRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $v = Social::create($req->all());

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.social')
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
    public function update($id, SocialRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                if($check = Social::find($id)){
                    $check->update($req->all());

                    $r = response([
                        'message' => __('label.success.update', [
                            'data' => __('label.social')
                        ])
                    ]);
                    DB::commit();
                }else{
                    $r = response([
                        'message' => __('label.error.not_found', [
                            'data' => __('label.social')
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
    public function delete($id){
        try {
            DB::beginTransaction();

            if($check = Social::find($id)){
                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.social')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.social')
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

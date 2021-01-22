<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetaRequest;
use App\Models\Meta;
use Illuminate\Support\Facades\DB;

class MetaController extends Controller
{
    public function table(){
        return response([
            'table' => Meta::latest()->get(),
            'list' => Meta::distinct()->orderBy('type')->get('type')
        ]);
    }
    public function create(MetaRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                Meta::create($req->all());

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.meta')
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
    public function update($id, MetaRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                if($check = Meta::find($id)){
                    $check->update($req->all());

                    $r = response([
                        'message' => __('label.success.update', [
                            'data' => __('label.meta')
                        ])
                    ]);
                    DB::commit();
                }else{
                    $r = response([
                        'message' => __('label.error.not_found', [
                            'data' => __('label.meta')
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

            if($check = Meta::find($id)){
                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.meta')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.meta')
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

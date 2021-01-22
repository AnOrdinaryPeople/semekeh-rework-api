<?php

namespace App\Http\Controllers;

use App\Http\Requests\FooterRequest;
use App\Models\Keyword;
use Illuminate\Support\Facades\DB;

class KeywordController extends Controller
{
    public function table(){
        return response(Keyword::latest()->get());
    }
    public function create(FooterRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                Keyword::create($req->all());

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.keyword')
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
    public function update($id, FooterRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                if($check = Keyword::find($id)){
                    $check->update($req->all());

                    $r = response([
                        'message' => __('label.success.update', [
                            'data' => __('label.keyword')
                        ])
                    ]);
                    DB::commit();
                }else{
                    $r = response([
                        'message' => __('label.error.not_found', [
                            'data' => __('label.keyword')
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

            if($check = Keyword::find($id)){
                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.keyword')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.keyword')
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

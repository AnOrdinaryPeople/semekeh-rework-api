<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function table(){
        return response(Company::orderBy('id', 'desc')->get());
    }
    public function create(CompanyRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $v = Company::create([
                    'url' => $req->file('url')->store('homepage', 'public'),
                    'link' => $req->link
                ]);
                imgCompress($v->url);

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.company')
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
    public function update($id, Request $req){
        try {
            DB::beginTransaction();

            if($check = Company::find($id)){
                if($req->url != 'null'){
                    Storage::disk('public')->delete($check->url);

                    $url = $req->file('url')->store('homepage', 'public');
                    imgCompress($url);
                }else $url = $check->url;

                $check->update([
                    'url' => $url,
                    'link' => $req->link
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.company')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.company')
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

            if($check = Company::find($id)){
                $s = Storage::disk('public');

                $s->delete($check->url);

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.company')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.company')
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

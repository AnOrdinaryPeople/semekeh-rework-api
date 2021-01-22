<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestationRequest;
use App\Models\Prestation as Pres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PrestationController extends Controller
{
    public function table(){
        return response(Pres::latest()->get());
    }
    public function create(PrestationRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $v = Pres::create([
                    'title' => $req->title,
                    'rank' => $req->rank,
                    'year' => $req->year,
                    'url' => $req->file('url')->store('prestation', 'public')
                ]);
                imgCompress($v->url);

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.prestation')
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

            if($check = Pres::find($id)){
                if($req->url != 'null'){
                    Storage::disk('public')->delete($check->url);

                    $url = $req->file('url')->store('prestation', 'public');
                    imgCompress($url);
                }else $url = $check->url;

                $check->update([
                    'title' => $req->title,
                    'rank' => $req->rank,
                    'year' => $req->year,
                    'url' => $url
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.prestation')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.prestation')
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

            if($check = Pres::find($id)){
                $s = Storage::disk('public');

                $s->delete($check->url);

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.prestation')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.prestation')
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

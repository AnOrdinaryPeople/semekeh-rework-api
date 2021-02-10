<?php

namespace App\Http\Controllers;

use App\Models\Prestation as Pres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PrestationController extends Controller
{
    public function table(){
        return response(Pres::latest()->get());
    }
    public function create(Request $req){
        $this->validate($req, [
            'title' => 'required|string',
            'rank' => 'required|string',
            'year' => 'required|numeric',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            Pres::create([
                'title' => $req->title,
                'rank' => $req->rank,
                'year' => $req->year,
                'url' => storeImage('url', 'prestation')
            ]);

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
        return $r;
    }
    public function update($id, Request $req){
        $this->validate($req, [
            'title' => 'required|string',
            'rank' => 'required|string',
            'year' => 'required|numeric',
            'url' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            if($check = Pres::find($id)){
                if($req->file('url')){
                    File::delete(toPath($check->url));

                    $url = storeImage('url', 'prestation');
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
                File::delete(toPath($check->url));

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

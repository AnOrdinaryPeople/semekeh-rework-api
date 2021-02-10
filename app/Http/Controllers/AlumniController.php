<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AlumniController extends Controller
{
    public function table(){
        return response(Alumni::latest()->get());
    }
    public function create(Request $req){
        $this->validate($req, [
            'name' => 'required|string',
            'company' => 'required|string',
            'content' => 'required|string',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            Alumni::create([
                'name' => ucfirst($req->name),
                'company' => $req->company,
                'content' => $req->content,
                'url' => storeImage('url', 'homepage')
            ]);

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.alumni')
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
            'name' => 'required|string',
            'company' => 'required|string',
            'content' => 'required|string',
            'url' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            if($check = Alumni::find($id)){
                if($req->file('url')){
                    File::delete(toPath($check->url));

                    $url = storeImage('url', 'homepage');
                }else $url = $check->url;

                $check->update([
                    'name' => ucfirst($req->name),
                    'company' => $req->company,
                    'content' => $req->content,
                    'url' => $url
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.alumni')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.alumni')
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

            if($check = Alumni::find($id)){
                File::delete(toPath($check->url));

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.alumni')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.alumni')
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
    public function publish($id){
        try {
            DB::beginTransaction();

            if($check = Alumni::find($id)){
                if(Alumni::whereIsPublish(true)->count() === 3 && $check->is_publish == false){
                    $r = response(['message' => __('label.error.limit', [
                        'data' => __('label.alumni'),
                        'number' => 3
                    ])], 422);
                }else{
                    $check->update(['is_publish' => !$check->is_publish]);
    
                    $r = response([
                        'message' => __('label.success.publish', [
                            'data' => __('label.alumni'),
                            'toggle' => $check->is_publish
                                ? __('label.published')
                                : __('label.unpublished')
                        ])
                    ]);
                    DB::commit();
                }
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.alumni')
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

<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    public function table(){
        return response(Video::latest()->get());
    }
    public function create(Request $req){
        $this->validate($req, [
            'thumbnail' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
            'video' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            Video::create([
                'thumbnail' => storeImage('thumbnail', 'homepage', $req),
                'video' => $req->video
            ]);

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.video')
                ])
            ]);
            DB::commit();
        } catch (Exception $e) {
            $r = response(['message' => __('auth.server_error')], 500);
            DB::rollback();
        }
        return $r;
    }
    public function delete($id){
        try {
            DB::beginTransaction();

            if($check = Video::find($id)){
                File::delete(toPath($check->thumbnail));
                File::delete(toPath($check->video));

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.video')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.video')
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

            if($check = Video::find($id)){
                if(Video::whereIsPublish(true)->count() === 4 && $check->is_publish == false){
                    $r = response(['message' => __('label.error.limit', [
                        'data' => __('label.video'),
                        'number' => 4
                    ])], 422);
                }else{
                    $check->update(['is_publish' => !$check->is_publish]);

                    $r = response([
                        'message' => __('label.success.publish', [
                            'data' => __('label.video'),
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
                        'data' => __('label.video')
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

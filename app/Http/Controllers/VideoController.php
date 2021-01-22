<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function table(){
        return response(Video::latest()->get());
    }
    public function create(VideoRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $v = Video::create([
                    'thumbnail' => $req->file('thumbnail')->store('homepage', 'public'),
                    'video' => $req->video
                ]);
                imgCompress($v->thumbnail);

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
        }
        return $r;
    }
    public function update($id, Request $req){
        try {
            DB::beginTransaction();

            if($check = Video::find($id)){
                if($req->thumbnail != 'null'){
                    Storage::disk('public')->delete($check->thumbnail);

                    $thumb = $req->file('thumbnail')->store('homepage', 'public');
                    imgCompress($thumb);
                }else $thumb = $check->thumbnail;

                if($req->video != 'null'){
                    Storage::disk('public')->delete($check->video);

                    $video = $req->file('video')->store('homepage', 'public');
                }else $video = $check->video;

                $check->update([
                    'thumbnail' => $thumb,
                    'video' => $video
                ]);

                $r = response([
                    'message' => __('label.success.update', [
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
    public function delete($id){
        try {
            DB::beginTransaction();

            if($check = Video::find($id)){
                $s = Storage::disk('public');

                $s->delete($check->thumbnail);
                $s->delete($check->video);

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

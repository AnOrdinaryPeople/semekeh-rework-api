<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StudyController extends Controller
{
    public function table(){
        return response(Study::orderBy('title')->get());
    }
    public function edit($id){
        return response(Study::whereSlug($id)->first());
    }
    public function update($id, Request $req){
        $this->validate($req, [
            'banner' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000',
            'title' => 'required|string|unique:studies,title,'.$id,
            'content' => 'required|string',
            'title_2' => 'required|string',
            'content_2' => 'required|string',
            'url' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            if($check = Study::find($id)){
                if(!empty($req->banner) && $req->hasFile('banner')){
                    File::delete(toPath($check->banner));

                    $url = storeImage('banner', 'study', $req);
                }else $url = $check->banner;

                $content = json_decode($check->content_2);

                if(!empty($req->url) && $req->hasFile('url')){
                    File::delete(toPath($content->url));

                    $urll = storeImage('url', 'study', $req);
                }else $urll = $content->url;

                $content = [
                    'title' => $req->title_2,
                    'content' => $req->content_2,
                    'url' => $urll
                ];

                $check->update([
                    'banner' => $url,
                    'title' => $req->title,
                    'content' => $req->content,
                    'content_2' => json_encode($content),
                    'slug' => kebabCase($req->title)
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.study')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.study')
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

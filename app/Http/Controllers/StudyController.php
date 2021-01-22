<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudyRequest;
use App\Models\Study;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudyController extends Controller
{
    public function table(){
        return response(Study::orderBy('title')->get());
    }
    public function edit($id){
        return response(Study::whereSlug($id)->first());
    }
    public function update($id, StudyRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                if($check = Study::find($id)){
                    if(!empty($req->banner) && $req->banner != 'null'){
                        Storage::disk('public')->delete($check->banner);

                        $url = $req->file('banner')->store('study', 'public');
                        imgCompress($url);
                    }else $url = $check->banner;

                    $content = json_decode($check->content_2);

                    if(!empty($req->url) && $req->url != 'null'){
                        Storage::disk('public')->delete($content->url);

                        $urll = $req->file('url')->store('study', 'public');
                        imgCompress($url);
                    }else $urll = $content->url;

                    $content = [
                        'title' => $req->title_2,
                        'content' => $req->content_2,
                        'url' => $urll
                    ];

                    $check->update([
                        'banner' => $url,
                        'name' => $req->title,
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
        }
        return $r;
    }
}

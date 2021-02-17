<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function table(){
        return response(News::latest()->get());
    }
    public function edit($id){
        return response(News::whereSlug($id)->first());
    }
    public function create(Request $req){
        $this->validate($req, [
            'title' => 'required|string',
            'banner' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
            'content' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            News::create([
                'title' => $req->title,
                'banner' => storeImage('banner', 'news', $req),
                'content' => $req->content,
                'slug' => kebabCase(strtotime(now()).' '.$req->title)
            ]);

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.news')
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
            'banner' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000',
            'content' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            if($check = News::find($id)){
                if($req->hasFile('banner')){
                    File::delete(toPath($check->banner));

                    $url = storeImage('banner', 'news', $req);
                }else $url = $check->banner;

                if($req->title !== $check->title)
                    $slug = kebabCase(strtotime(now()).' '.$req->title);
                else $slug = $check->slug;

                $check->update([
                    'title' => $req->title,
                    'banner' => $url,
                    'content' => $req->content,
                    'slug' => $slug
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.news')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.news')
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

            if($check = News::find($id)){
                File::delete(toPath($check->banner));

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.news')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.news')
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

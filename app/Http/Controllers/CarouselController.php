<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    public function table(){
        return response(Carousel::latest()->get());
    }
    public function create(Request $req){
        $this->validate($req, [
            'type' => 'required|numeric|min:1|max:2',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            Carousel::create([
                'type' => $req->type,
                'title' => $req->title,
                'description' => $req->description,
                'url' => storeImage('url', 'homepage')
            ]);

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.carousel')
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
            'type' => 'required|numeric|min:1|max:2',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'url' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            if($check = Carousel::find($id)){
                if($req->file('url')){
                    File::delete(toPath($check->url));

                    $url = storeImage('url', 'homepage');
                }else $url = $check->url;

                $check->update([
                    'type' => $req->type,
                    'title' => $req->title,
                    'description' => $req->description,
                    'url' => $url
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.carousel')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.carousel')
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

            if($check = Carousel::find($id)){
                File::delete(toPath($check->url));

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.carousel')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.carousel')
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

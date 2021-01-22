<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarouselRequest;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function table(){
        return response(Carousel::latest()->get());
    }
    public function create(CarouselRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $v = Carousel::create([
                    'type' => $req->type,
                    'title' => $req->title,
                    'description' => $req->description,
                    'url' => $req->file('url')->store('homepage', 'public')
                ]);
                imgCompress($v->url);

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
        }
        return $r;
    }
    public function update($id, Request $req){
        try {
            DB::beginTransaction();

            if($check = Carousel::find($id)){
                if($req->url != 'null'){
                    Storage::disk('public')->delete($check->url);

                    $url = $req->file('url')->store('homepage', 'public');
                    imgCompress($url);
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
                $s = Storage::disk('public');

                $s->delete($check->url);

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

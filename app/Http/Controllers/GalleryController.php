<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function table(){
        return response(Gallery::whereTarget(0)->latest()->get());
    }
    public function create(Request $req){
        $this->validate($req, [
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
        ]);

        try {
            DB::beginTransaction();

            Gallery::create([
                'url' => storeImage('url', 'gallery', $req)
            ]);

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.image')
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

            if($check = Gallery::find($id)){
                File::delete(toPath($check->url));

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.image')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.image')
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

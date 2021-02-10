<?php

namespace App\Http\Controllers;

use App\Models\Council;
use App\Models\Gallery;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function getData($id){
        return response([
            'table' => Profile::find($id),
            'img' => Gallery::whereTarget(1)
                ->whereType($id)
                ->latest()
                ->get()
        ]);
    }
    public function council(){
        return response(Council::find(1));
    }
    public function updateCouncil(Request $req){
        try {
            DB::beginTransaction();

            Council::find(1)->update($req->all());

            $r = response([
                'message' => __('label.success.update', [
                    'data' => __('label.student_council')
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
            'subtitle' => 'nullable|string',
            'content' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            if($check = Profile::find($id)){
                $check->update($req->all());

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => $check->title
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.profile')
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
    public function createImg($id, Request $req){
        $this->validate($req, [
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
        ]);

        try {
            DB::beginTransaction();

            Gallery::create([
                'target' => 1,
                'type' => $id,
                'url' => storeImage('url', 'profile', $req)
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
    public function deleteImg($id){
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

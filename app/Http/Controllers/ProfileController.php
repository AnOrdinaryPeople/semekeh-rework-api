<?php

namespace App\Http\Controllers;

use App\Models\Council;
use App\Models\Gallery;
use App\Models\Profile;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    public function update($id, ProfileRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
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
        }
        return $r;
    }
    public function createImg($id, GalleryRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $a = Gallery::create([
                    'target' => 1,
                    'type' => $id,
                    'url' => $req->file('url')->store('profile', 'public')
                ]);
                imgCompress($a->url);

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
        }
        return $r;
    }
    public function deleteImg($id){
        try {
            DB::beginTransaction();

            if($check = Gallery::find($id)){
                $s = Storage::disk('public');

                $s->delete($check->url);

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

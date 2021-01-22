<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\GalleryRequest;
use App\Models\Employee;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function table(){
        return response([
            'employee' => Employee::latest()->get(),
            'img' => Gallery::whereTarget(4)
                ->latest()
                ->get()
        ]);
    }
    public function create(EmployeeRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $v = Employee::create([
                    'name' => $req->name,
                    'title' => $req->title,
                    'type' => $req->type,
                    'child_type' => $req->type == 1 ? 3 : 0,
                    'url' => $req->file('url')->store('employees', 'public')
                ]);
                imgCompress($v->url);

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.employee')
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

            if($check = Employee::find($id)){
                if($req->url != 'null'){
                    if($check->url !== 'user.png')
                        Storage::disk('public')->delete($check->url);

                    $url = $req->file('url')->store('employees', 'public');
                    imgCompress($url);
                }else $url = $check->url;

                $check->update([
                    'name' => $req->name,
                    'title' => $req->title,
                    'type' => $req->type != 1 ? $req->type : $check->type,
                    'url' => $url
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.employee')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.employee')
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

            if($check = Employee::find($id)){
                $s = Storage::disk('public');

                if($check->url !== 'user.png')
                    $s->delete($check->url);

                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.employee')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.employee')
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
    public function createImg(GalleryRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $a = Gallery::create([
                    'target' => 4,
                    'url' => $req->file('url')->store('agenda', 'public')
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

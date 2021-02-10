<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
    public function create(Request $req){
        $this->validate($req, [
            'title' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|numeric|min:1|max:3',
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            Employee::create([
                'name' => $req->name,
                'title' => $req->title,
                'type' => $req->type,
                'child_type' => $req->type == 1 ? 3 : 0,
                'url' => storeImage('url', 'employees', $req)
            ]);

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
        return $r;
    }
    public function update($id, Request $req){
        $this->validate($req, [
            'title' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|numeric|min:1|max:3',
            'url' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            if($check = Employee::find($id)){
                if($req->hasFile('url')){
                    if($check->url !== 'user.png')
                        File::delete(toPath($check->url));

                    $url = storeImage('url', 'employees', $req);
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
                if($check->url !== 'user.png')
                    File::delete(toPath($check->url));

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
    public function createImg(Request $req){
        $this->validate($req, [
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
        ]);

        try {
            DB::beginTransaction();

            Gallery::create([
                'target' => 4,
                'url' => storeImage('url', 'employees', $req),
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

<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Support\Facades\DB;

class FooterController extends Controller
{
    public function table(){
        return response(Footer::latest()->get());
    }
    public function create(Request $req){
        $this->validate($req, [
            'key' => 'required|string',
            'value' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            Footer::create($req->all());

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.footer')
                ])
            ]);
            DB::commit();
        } catch (Exception $e) {
            $r = response(['message' => __('auth.server_error')], 500);
            DB::rollback();
        }
        return $r;
    }
    public function update($id, FooterRequest $req){
        $this->validate($req, [
            'key' => 'required|string',
            'value' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            if($check = Footer::find($id)){
                $check->update($req->all());

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.footer')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.footer')
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

            if($check = Footer::find($id)){
                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.footer')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.footer')
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

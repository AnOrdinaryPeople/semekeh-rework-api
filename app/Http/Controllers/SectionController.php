<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function table(){
        return response(Section::orderBy('id')->get());
    }
    public function update($id, SectionRequest $req){
        try {
            DB::beginTransaction();

            if($check = Section::find($id)){
                $check->update($req->all());

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.section')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.section')
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

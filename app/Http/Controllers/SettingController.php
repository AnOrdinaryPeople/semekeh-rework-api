<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index(){
        return response([
            'foundation' => Keyword::oldest('id')->first()->value,
            'table' => History::getAll()
        ]);
    }
    public function foundation($id, Request $req){
        $this->validate($req, [
            'value' => [
                'required',
                'string',
                'regex:#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i'
            ]
        ]);

        try {
            DB::beginTransaction();

            if($check = Keyword::find($id)){
                $check->update($req->all());

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.keyword')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.keyword')
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
    public function cache(Request $req){
        Artisan::call('cache:refresh', [
            'timer' => @$req->timer ?? 'month'
        ]);

        History::create(['user_id' => app('auth')->user()->id]);

        return response([
            'message' => 'Database cache has been created.',
            'table' => History::getAll()
        ]);
    }
}

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
        $timer = @$req->timer ?? 'month';

        switch ($timer) {
            case 'year':
                $str = '1 year';
                break;
            case 'month':
                $str = '1 month';
                break;
            case 'week':
                $str = '1 week';
                break;
            case 'day':
                $str = '1 day';
                break;

            default:
                $str = '3 days';
                break;
        }

        Artisan::call('cache:refresh', [
            'timer' => $timer
        ]);

        History::create([
            'user_id' => app('auth')->user()->id,
            'duration' => $str,
            'expire' => date('Y-m-d H:i:s', strtotime('+'.$str, strtotime(now())))
        ]);

        return response([
            'message' => __('label.success.create', [
                'data' => __('label.db_cache')
            ]),
            'table' => History::getAll()
        ]);
    }
}

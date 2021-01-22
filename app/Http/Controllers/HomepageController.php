<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Audit;
use App\Models\Carousel;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index(){
        return response([
            'carousel' => Carousel::latest()->get(),
            'about' => About::find(1),
            'section' => Section::orderBy('id')->get()
        ]);
    }
    public function aboutUpdate(Request $req){
        try {
            DB::beginTransaction();

            $a = About::find(1);

            if($req->url != 'null'){
                Storage::disk('public')->delete($a->url);

                $img = $req->file('url')->store('homepage', 'public');
                imgCompress($img);
            }else $img = $a->url;

            $a->update([
                'content' => $req->content,
                'url' => $img
            ]);

            $r = response([
                'result' => $a,
                'message' => __('label.success.update', [
                    'data' => __('label.about')
                ])
            ]);
            DB::commit();
        } catch (Exception $e) {
            $r = response(['message' => __('auth.server_error')], 500);
            DB::rollback();
        }
        return $r;
    }
    public function upload($path, Request $req){
        return response([
            'url' => $req->file('file')->store('video', 'public')
        ]);
    }
    public function audit(){
        $a = Audit::getAll();

        foreach($a as $b)
            $data[] = [
                'by_user' => $b->name ?? __('label.user_not_found'),
                'module' => str_replace('App\\Models\\', '', $b->auditable_type),
                'event' => $b->event,
                'created_at' => date('Y M d H:i:s', strtotime($b->created_at)),
                'ip_address' => $b->ip_address,
                'user_agent' => $b->user_agent,
                'old_values' => $b->old_values,
                'new_values' => $b->new_values
            ];

        return response($data ?? []);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaRequest;
use App\Http\Requests\GalleryRequest;
use App\Models\Agenda;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function table(){
        return response(Agenda::latest()->get());
    }
    public function edit($id){
        $a = Agenda::whereSlug($id)->first();

        return response([
            'agenda' => $a,
            'img' => Gallery::whereTarget(3)
                ->whereType($a->id)
                ->latest()
                ->get()
        ]);
    }
    public function create(AgendaRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $v = Agenda::create([
                    'title' => $req->title,
                    'time' => $req->time,
                    'content' => $req->content,
                    'slug' => kebabCase(strtotime(now()).' '.$req->title),
                    'banner' => $req->file('banner')->store('agenda', 'public')
                ]);
                imgCompress($v->banner);

                $r = response([
                    'message' => __('label.success.create', [
                        'data' => __('label.agenda')
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

            if($check = Agenda::find($id)){
                if($req->banner != 'null'){
                    Storage::disk('public')->delete($check->banner);

                    $url = $req->file('banner')->store('agenda', 'public');
                    imgCompress($url);
                }else $url = $check->banner;

                if($req->title !== $check->title)
                    $slug = kebabCase(strtotime(now()).' '.$req->title);
                else $slug = $check->slug;

                $check->update([
                    'title' => $req->title,
                    'time' => $req->time,
                    'content' => $req->content,
                    'banner' => $url,
                    'slug' => $slug
                ]);

                $r = response([
                    'message' => __('label.success.update', [
                        'data' => __('label.agenda')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.agenda')
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

            if($check = Agenda::find($id)){
                $s = Storage::disk('public');
                $g = Gallery::whereTarget(3)
                    ->whereType($id);

                foreach ($g->get() as $i)
                    $s->delete($i->url);

                $s->delete($check->banner);

                $g->delete();
                $check->delete();

                $r = response([
                    'message' => __('label.success.delete', [
                        'data' => __('label.agenda')
                    ])
                ]);
                DB::commit();
            }else{
                $r = response([
                    'message' => __('label.error.not_found', [
                        'data' => __('label.agenda')
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
    public function createImg($id, GalleryRequest $req){
        if($req->val && $req->val->fails())
            $r = response($req->val->errors(), 422);
        else{
            try {
                DB::beginTransaction();

                $a = Gallery::create([
                    'target' => 3,
                    'type' => $id,
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

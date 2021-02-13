<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
    public function create(Request $req){
        $this->validate($req, [
            'title' => 'required|string',
            'time' => 'required|string',
            'content' => 'required|string',
            'banner' => 'required|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            $a = Agenda::create([
                'title' => $req->title,
                'time' => $req->time,
                'content' => $req->content,
                'slug' => kebabCase(strtotime(now()).' '.$req->title),
                'banner' => storeImage('banner', 'agenda', $req)
            ]);

            $r = response([
                'message' => __('label.success.create', [
                    'data' => __('label.agenda')
                ]),
                'slug' => $a->slug
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
            'time' => 'required|string',
            'content' => 'required|string',
            'banner' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048000'
        ]);

        try {
            DB::beginTransaction();

            if($check = Agenda::find($id)){
                if($req->hasFile('banner')){
                    File::delete(toPath($check->banner));

                    $url = storeImage('banner', 'agenda', $req);
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
                $g = Gallery::whereTarget(3)
                    ->whereType($id);

                foreach ($g->get() as $i)
                    File::delete(toPath($i->url));

                File::delete(toPath($check->banner));

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
    public function createImg($id, Request $req){
        $this->validate($req, [
            'url' => 'required|mimes:jpg,jpeg,png,webp|max:2048000',
        ]);

        try {
            DB::beginTransaction();

            Gallery::create([
                'target' => 3,
                'type' => $id,
                'url' => storeImage('url', 'agenda', $req)
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

<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Agenda;
use App\Models\Alumni;
use App\Models\Carousel;
use App\Models\Company;
use App\Models\Council;
use App\Models\Employee;
use App\Models\Footer;
use App\Models\Gallery;
use App\Models\Keyword;
use App\Models\Meta;
use App\Models\Prestation;
use App\Models\Profile;
use App\Models\Section;
use App\Models\Social;
use App\Models\Study;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    public function meta(){
        if($c = Cache::get('meta'))
            $data = $c;
        else{
            $data = ['data' => Meta::orderBy('id')->get(['type', 'key', 'value'])];

            Cache::put('meta', $data, timer('month'));
        }

    	return response($data);
    }
    public function navbar(){
        if($c = Cache::get('navbar'))
            $data = $c;
        else{
            $data = [
                'bpi' => Keyword::find(1)->value,
                'study' => Study::orderBy('title')->get(['title', 'slug'])
            ];

            Cache::put('navbar', $data, timer('month'));
        }

        return response($data);
    }
    public function footer(){
        if($c = Cache::get('footer'))
            $data = $c;
        else{
            $data = [
                'agenda' => Agenda::latest()->first(['banner', 'title', 'time', 'slug']),
                'footer' => Footer::latest()->get(['key', 'value'])
            ];

            Cache::put('footer', $data, timer('month'));
        }
        return response($data);
    }
    public function home(){
        if($c = Cache::get('home'))
            $data = $c;
        else{
            $data = [
                'carousel' => Carousel::oldest()->get(['description', 'title', 'type', 'url']),
                'video' => Video::whereIsPublish(true)->latest()->get(['thumbnail', 'video']),
                'about' => About::whereId(1)->first(['content', 'url']),
                'alumni' => Alumni::whereIsPublish(true)->latest()->get(['company', 'content', 'name', 'url']),
                'company' => Company::latest()->get(['link', 'url']),
                'section' => Section::orderBy('id')->get(['title', 'subtitle']),
                'prestation' => Prestation::latest()->limit(3)->get(['rank', 'title', 'url', 'year']),
                'agenda' => Agenda::latest()->first(['banner', 'content', 'slug', 'time', 'title'])
            ];

            Cache::put('home', $data, timer('month'));
        }

        return response($data);
    }
    public function keyword(){
        if($c = Cache::get('keyword'))
            $data = $c;
        else{
            $data = Keyword::get(['key', 'value']);

            Cache::put('keyword', $data, timer('month'));
        }

        return response($data);
    }
    public function social(){
        if($c = Cache::get('social'))
            $data = $c;
        else{
            $data = Social::latest()->get(['icon', 'link']);

            Cache::put('social', $data, timer('month'));
        }

        return response($data);
    }
    public function profile($id){
        if($c = Cache::get('profile'.$id))
            $r = $c;
        else{
            if($check = Profile::find($id)){
                $obj = [
                    'content' => $check,
                    'img' => Gallery::whereTarget(1)
                        ->whereType($check->id)
                        ->latest()
                        ->get('url')
                ];

                if($check->id === 3)
                    $obj['council'] = Council::whereId(1)->first(['title', 'json']);

                $r = $obj;
 
                Cache::put('profile'.$id, $r, timer('month'));
            }else
                $r = ['content' => null, 'img' => []];
        }

        return response($r);
    }
    public function study($id){
        $str = str_replace('-', '', $id);

        if($c = Cache::get('study'.$str))
            $r = $c;
        else{
            if($check = Study::whereSlug($id)->first(['banner', 'title', 'content', 'content_2', 'slug'])){
                $r = $check;

                Cache::put('study'.$str, $r, timer('month'));
            }else $r = null;
        }

        return response($r);
    }
    public function agenda(){
        if($c = Cache::get('agenda'))
            $data = $c;
        else{
            $data = Agenda::latest()->get(['slug', 'title', 'time', 'content', 'banner']);

            Cache::put('agenda', $data, timer('month'));
        }

        return response($data);
    }
    public function agendaDetail($id){
        $str = str_replace('-', '', $id);

        if($c = Cache::get('agenda'.$str))
            $r = $c;
        else{
            if($a = Agenda::whereSlug($id)->first()){
                $r = [
                    'agenda' => $a->only(['slug', 'title', 'time', 'content', 'banner']),
                    'img' => Gallery::whereTarget(3)
                        ->whereType($a->id)
                        ->latest()
                        ->get('url'),
                    'other' => Agenda::where('id', '!=', $a->id)
                        ->inRandomOrder()
                        ->limit(3)
                        ->get(['title', 'time', 'banner', 'slug'])
                ];

                Cache::put('agenda'.$str, $r, timer('month'));
            }else $r = null;
        }

        return response($r);
    }
    public function prestation(){
        if($c = Cache::get('prestation'))
            $data = $c;
        else{
            $data = Prestation::latest()->get(['title', 'rank', 'year', 'url']);

            Cache::put('prestation', $data, timer('month'));
        }

        return response($data);
    }
    public function gallery(){
        if($c = Cache::get('gallery'))
            $data = $c;
        else{
            $data = [
                'img' => Gallery::latest('id')->get('url'),
                'video' => Video::latest()->get(['thumbnail', 'video'])
            ];

            Cache::put('gallery', $data, timer('month'));
        }

        return response($data);
    }
    public function employee(){
        if($c = Cache::get('employee'))
            $data = $c;
        else{
            $data = [
                'employee' => Employee::latest()->get(['title', 'name', 'url', 'type', 'child_type']),
                'img' => Gallery::whereTarget(4)
                    ->latest()
                    ->get('url')
            ];

            Cache::put('employee', $data, timer('month'));
        }

        return response($data);
    }
    public function search(){
        return response([
            'agenda' => Agenda::search(request()->q),
            'pres' => Prestation::search(request()->q)
        ]);
    }
    // public function viewFile($path){
    //     return response()->file($path);
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public static function getMenu(){
        $parent = self::where('parent_id', 0)->orderBy('id')->get();
        $i = 0;

        foreach($parent as $s){
            $result[$i] = [
                'icon' => $s->icon,
                'name' => $s->name,
                'link' => $s->link
            ];
            $getParent = self::whereParentId($s->id)->get();
            
            foreach($getParent as $c){
                $result[$i]['children'][] = [
                    'icon' => $c->icon,
                    'name' => $c->name,
                    'link' => $result[$i]['link'].$c->link
                ];
            }
            $i++;
        }

        return $result;
    }
}

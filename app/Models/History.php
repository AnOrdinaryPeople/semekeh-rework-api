<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['user_id', 'duration', 'expire'];

    public static function getAll(){
    	return self::latest()
    		->join('users', 'users.id', '=', 'user_id')
    		->get(['name', 'duration', 'expire', 'histories.created_at'])
    		->map(function($data, $key){
    			return [
                    'key' => $key,
    				'name' => $data->name,
    				'duration' => $data->duration,
    				'expire' => date('l, Y M d, H:i', strtotime($data->expire)),
    				'created_at' => date('Y M d H:i:s', strtotime($data->created_at))
    			];
    		});
    }
}

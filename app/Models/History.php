<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['user_id'];

    public static function getLatest(){
    	return self::latest()
    		->join('users', 'users.id', '=', 'user_id')
    		->first(['name', 'histories.created_at']);
    }

    public static function getAll(){
    	return self::latest()
    		->join('users', 'users.id', '=', 'user_id')
    		->get(['name', 'histories.created_at'])
    		->map(function($data){
    			return [
    				'name' => $data->name,
    				'created_at' => date('Y M d H:i:s', strtotime($data->created_at))
    			];
    		});
    }
}

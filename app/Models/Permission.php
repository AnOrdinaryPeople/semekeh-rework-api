<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    public static function getAccess($r_id){
        return self::select('name', 'status')
            ->join('has_permissions', 'permissions.id', '=', 'permission_id')
            ->whereRoleId($r_id)
            ->pluck('status', 'name');
    }
    public static function createNew($arr, $id){
    	foreach($arr as $a)
    		DB::table('has_permissions')
    			->insert([
    				'permission_id' => self::whereName($a['permission'])->first()->id,
    				'role_id' => $id,
    				'status' => $a['status'],
    				'created_at' => now(),
    				'updated_at' => now()
    			]);
    }
    public static function updatee($arr, $id){
    	foreach($arr as $a){
    		$b = self::whereName($a['permission'])->first()->id;

    		DB::table('has_permissions')
    			->wherePermissionId($b)
    			->whereRoleId($id)
    			->update([
    				'status' => $a['status'],
    				'updated_at' => now()
    			]);
    	}
    }
    public static function woosh($id){
    	DB::table('has_permissions')->whereRoleId($id)->delete();
    }
}

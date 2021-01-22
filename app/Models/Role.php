<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['name'];

    public static function getEdit($id){
        return self::join('has_permissions', 'role_id', '=', 'roles.id')
            ->join('permissions', 'permission_id', '=', 'permissions.id')
            ->where('roles.id', $id)
            ->get(['permissions.name as permission', 'status']);
    }
}

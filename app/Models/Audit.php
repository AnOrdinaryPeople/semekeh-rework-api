<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    public static function getAll(){
        return self::leftJoin('users', 'users.id', '=', 'user_id')
            ->orderBy('audits.created_at', 'desc')
            ->get([
            	'name',
            	'auditable_type',
            	'event',
            	'audits.created_at',
            	'ip_address',
            	'user_agent',
            	'old_values',
            	'new_values',
            ]);
    }
}

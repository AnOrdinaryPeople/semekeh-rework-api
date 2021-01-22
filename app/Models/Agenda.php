<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Agenda extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['title', 'time', 'content', 'banner', 'slug'];

    public static function search($q){
        return self::where('title', 'like', "%$q%")
            ->orWhere('content', 'like', "%$q%")
            ->latest()
            ->get(['title', 'time', 'banner', 'slug']);
    }
}

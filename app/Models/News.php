<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class News extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['banner', 'title', 'content', 'slug'];

    public static function search($q){
        return self::where('title', 'like', "%$q%")
            ->orWhere('content', 'like', "%$q%")
            ->latest()
            ->get(['title', 'banner', 'slug']);
    }
}

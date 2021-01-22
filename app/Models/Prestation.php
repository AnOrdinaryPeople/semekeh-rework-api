<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Prestation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['title', 'rank', 'year', 'url'];

    public static function search($q){
        return self::where('title', 'like', "%$q%")
        	->latest()
            ->get(['title', 'rank', 'year', 'url']);
    }
}

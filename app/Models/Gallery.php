<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Gallery extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['target', 'type', 'url'];
}

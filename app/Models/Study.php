<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Study extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['banner', 'title', 'content', 'content_2', 'slug'];
}

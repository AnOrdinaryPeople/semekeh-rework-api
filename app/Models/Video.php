<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Video extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['thumbnail', 'video', 'is_publish'];
}

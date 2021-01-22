<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Carousel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['type', 'title', 'description', 'url'];
}

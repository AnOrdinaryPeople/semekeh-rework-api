<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Meta extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['type', 'key', 'value'];
}

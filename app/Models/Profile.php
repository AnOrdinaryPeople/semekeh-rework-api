<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Profile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['title', 'subtitle', 'content'];
}

<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements Auditable, JWTSubject, AuthenticatableContract
{
    use Authenticatable,
        \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUser($id){
        return $this->join('roles', 'roles.id', '=', 'role_id')
            ->where('users.id', $id)
            ->first(['users.id', 'users.name', 'email', 'roles.name as role']);
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user' => $this->getUser($this->id),
            'access' => Permission::getAccess($this->role_id),
            'menu' => Menu::getMenu()
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use App\Models\Role;
use App\Models\Team;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->hasMany(Role::class, 'user_id', 'id');
    }
    public function teams() {
        return $this->belongsToMany(Team::class,'team_user', 'user_id', 'team_id');
    }
    public function apps() {
        return $this->belongsToMany(App::class,'app_user', 'user_id', 'app_id');
    }
    public function privileges() {
        return $this->belongsToMany(Privilege::class,'privilege_user', 'user_id', 'privilege_id');
    }
    public function roles() {
        return $this->belongsToMany(Role::class,'role_user', 'user_id', 'role_id');
    }
    
    public function hasRole(... $roles)
    {
        foreach ($roles as $role) {
            if ($this->role->contains('name', $role))
            {
                return true;
            }
        }
        return false;
    }

    public function hasPrivilege(... $privileges)
    {
        foreach ($privileges as $privilege) {
            if ($this->privileges->contains('name', $privilege))
            {
                return true;
            }
        }
        return false;
    }
    public function hasApp(... $apps)
    {
        foreach ($apps as $app) {
            if ($this->apps->contains('name', $app))
            {
                return true;
            }
        }
        return false;
    }
}

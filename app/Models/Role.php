<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public $timestamps = true;

    protected $fillable = [
        'name', 'app_id', 'team_id', 'user_id'
    ];
    public function users() {
        return $this->belongsToMany(User::class,'role_user', 'role_id', 'user_id');
    }
}

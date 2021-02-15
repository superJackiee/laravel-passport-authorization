<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;
class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    public $timestamps = true;

    public function users() {
        return $this->belongsToMany(User::class,'team_user', 'team_id', 'user_id');
    }

    protected $fillable = [
        'name', 'maxmembers', 'parent_team'
    ];
}

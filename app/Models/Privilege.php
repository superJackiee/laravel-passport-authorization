<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;
    protected $table = 'privileges';
    public $timestamps = true;

    public function users() {
        return $this->belongsToMany(User::class,'privilege_user', 'privilege_id', 'user_id');
    }

    protected $fillable = [
        'name'
    ];
}

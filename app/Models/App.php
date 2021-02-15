<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    protected $table = 'apps';
    public $timestamps = true;

    public function users() {
        return $this->belongsToMany(User::class,'app_user', 'app_id', 'user_id');
    }

    protected $fillable = [
        'name'
    ];

}

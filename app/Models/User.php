<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

}

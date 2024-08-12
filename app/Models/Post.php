<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
protected $fillable = [
  'user_id',
  'category_id',
  'title',
  'short_content',
  'content',
  'photo'
];
//relations
public function user():BelongsTo
{
    return $this->belongsTo(User::class);
}
public function category():BelongsTo
{
    return $this->belongsTo(Category::class);
}

public function comments():HasMany
{
    return $this->hasMany(Comment::class);
}
public function tags():BelongsToMany
{
    return $this->belongsToMany(Tag::class);
}
//end relations

}

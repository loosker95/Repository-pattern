<?php

namespace App\Models;

use App\Models\Comment;
use Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'author',
        'title',
        'slug',
        'author',
        'summary',
        'body',
    ];

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value . ' +' . Str::uuid());
    }

    // protected function slugPost(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn ($value) => Str::slug($value . ' +' . Str::uuid())
    //     );
    // }
}

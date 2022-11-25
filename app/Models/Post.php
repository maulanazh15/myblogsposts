<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $with = ['user', 'category']; 


    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('title','like','%'.$search.'%')
                ->orWhere('body','like','%'.$search.'%');
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category',function($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['user'] ?? false, function($query, $user) {
            return $query->whereHas('user',function($query) use ($user) {
                $query->where('username', $user);
            });
        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}


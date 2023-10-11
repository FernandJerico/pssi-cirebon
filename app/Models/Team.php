<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category'];

    public function scopeFilter($query, array $filters)
    {
        $query->when(($filters['search']) ?? false, function($query, $search){
            return $query->where('team_name', 'like', '%' . $search. '%')
                        ->orWhere('description', 'like', '%' .$search. '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'team_name'
            ]
        ];
    }
}
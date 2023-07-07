<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'categories';
    public $guarded = [];

    protected $casts = [
        'image' => 'json'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent','id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

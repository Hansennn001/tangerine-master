<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image', 'category_id'];
    protected $with = ["serviceDetails", "category"];

    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class);
    }

    public function category()
    {
    return $this->belongsTo(Category::class);
    }

}

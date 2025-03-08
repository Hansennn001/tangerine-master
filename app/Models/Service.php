<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];
    protected $with = "serviceDetails";

    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}

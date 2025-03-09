<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];

    public function beautician()
    {
        return $this->belongsTo(Beautician::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

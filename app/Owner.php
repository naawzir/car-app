<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Model;

class Owner extends Model
{
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}

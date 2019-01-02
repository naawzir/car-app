<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Model;

class Car extends Model
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}

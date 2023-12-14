<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCategory extends Model
{
    use HasFactory;
    protected $table='restaurant_categories';
    protected $fillbale=['name','slug','image','status'];

    public function restaurants()
    {
        return $this->hasMany(RestaurantModel::class,'category_id');
    }

    public function getRestaurantCountAttribute()
    {
        return $this->restaurants()->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantModel extends Model
{
    use HasFactory;
    protected $table='restaurant';
    protected $fillable=['category_id','user_id','image','coverimage','name','slug','address','map','phone','email','openninghours','deliverytime','status','popular'];

public function category()
{
    return $this->belongsTo(RestaurantCategory::class,'category_id');
}


public function order()
{
    return $this->hasMany(OrderModel::class,'restaurant_id');
}


public function user()
{
    return $this->belongsTo(User::class);
}

public function menuCategories()
{
    return $this->hasMany(MenuCategories::class, 'restaurant_id');
}


}

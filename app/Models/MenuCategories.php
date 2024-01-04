<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategories extends Model
{
    use HasFactory;
    protected $table='menu_categories';
    protected $fillable=['restaurant_id','name','slug','image','status'];

public function menuitems()
{
    return $this->hasMany(MenuItems::class,'menu_category_id');
}

public function getMenuitemsCountAttribute()
{
    return $this->menuitems()->count();
}

public function restaurant()
{
    return $this->belongsTo(RestaurantModel::class, 'restaurant_id');
}

public function orders()
{
    return $this->hasMany(OrderModel::class);
}

}

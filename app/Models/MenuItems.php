<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;
    protected $table='menu_items';
    protected $fillable=['menu_category_id','name','slug','price','image'];

    public function menucategories()
    {
        return $this->belongsTo(MenuCategories::class,'menu_category_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'menu_id', 'id');
    }
}

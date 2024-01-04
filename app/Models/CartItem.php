<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table='cart_items';
    protected $fillable=['user_id','menu_item_id','quantity','price'];
    
    public function menuitems()
    {
        return $this->belongsToMany(MenuItems::class, 'cart_item_menu_item', 'cart_item_id', 'menu_item_id')
        ->withPivot('quantity')
        ->withTimestamps();
    }
    public function menuItemswithouroffer()
    {
        return $this->belongsTo(MenuItems::class);
    }

public function user()
{
    return $this->belongsTo(User::class);
}

public function appliedOffer()
{
    return $this->hasOne(AppliedOffer::class);
}

}

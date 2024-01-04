<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model
{
    use HasFactory;
    protected $table='wishlist';
    protected $fillable=['user_id','menu_item_id'];

    public function menuitems()
    {
        return $this->belongsTo(MenuItems::class, 'menu_item_id');
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }


    public function offers()
{
    return $this->belongsToMany(Offer::class, 'wishlist_offer', 'wishlist_model_id', 'offer_id');
}

}

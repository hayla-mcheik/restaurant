<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table='offers';
    protected $fillable=[
    'name',
    'description',
    'discount_type',
    'discount_value',
    'start_date',
    'end_date',
    'image',
    'is_published',
    'restaurant_id',
    ];

    public function menuItems()
    {
        return $this->belongsToMany(MenuItems::class, 'menu_item_offer', 'offer_id', 'menu_item_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(RestaurantModel::class, 'restaurant_id');
    }
    public function appliedOffers()
    {
        return $this->hasMany(AppliedOffer::class);
    }
    public function wishlists()
{
    return $this->belongsToMany(WishlistModel::class, 'wishlist_offer', 'offer_id', 'wishlist_model_id');
}
}

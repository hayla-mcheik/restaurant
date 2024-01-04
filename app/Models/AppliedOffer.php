<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedOffer extends Model
{
    use HasFactory;
    protected $table='applied_offers';
    protected $fillable = [
        'cart_item_id',
        'offer_id',
        'discount_value',
    ];

    // Relationships
    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

}

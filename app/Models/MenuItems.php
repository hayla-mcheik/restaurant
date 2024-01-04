<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;
    protected $table='menu_items';
    protected $fillable=['menu_category_id','name','slug','quantity','price','image'];

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'menu_item_offer', 'menu_item_id', 'offer_id');
    }

    public function menuCategories()
    {
        return $this->belongsTo(MenuCategories::class, 'menu_category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'menu_id', 'id');
    }

    public function bestSeller()
    {
        $bestSeller = $this->orderItems()
            ->selectRaw('menu_id, SUM(quantity) as total_quantity')
            ->groupBy('menu_id')
            ->orderByDesc('total_quantity')
            ->first(); 
        return $bestSeller ? [
            'menu_id' => $bestSeller->menu_id,
            'total_quantity' => $bestSeller->total_quantity,
        ] : null;
    }

    public static function mostPopularCategories()
    {
        return static::selectRaw('menu_categories.id, menu_categories.name, menu_categories.image, COUNT(*) as total_items_sold')
            ->join('menu_categories', 'menu_items.menu_category_id', '=', 'menu_categories.id')
            ->join('order_items', 'menu_items.id', '=', 'order_items.menu_id')
            ->groupBy('menu_categories.id', 'menu_categories.name', 'menu_categories.image')
            ->orderByDesc('total_items_sold')
            ->get();
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table='order_items';
    protected $fillable=['order_id','menu_id','quantity','price'];

    public function menu()
    {
        return $this->belongsTo(MenuModel::class, 'menu_id', 'id');
    }

}

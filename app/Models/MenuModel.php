<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table='menu';
    protected $fillable=['name','slug','price','image'];
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'menu_id', 'id');
    }
}

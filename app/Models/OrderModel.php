<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    
    use HasFactory;
protected $table='orders';
protected $fillable=['user_id','restaurant_id','fullname','email','phone','address','order_no','status_message','payment_mode','payment_id'];
protected $dates = ['date', 'deliverydate'];

public function user()
{
    return $this->belongsTo(User::class);
}

public function orderItems()
{
    return $this->hasMany(OrderItems::class, 'order_id');
}

public function restaurant()
{
    return $this->belongsTo(RestaurantModel::class,'restaurant_id');
}
}

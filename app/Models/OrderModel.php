<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
protected $table='orders';
protected $fillable=['user_id','name','slug','address','order_no','status_message','payment_mode','payment_id'];
protected $dates = ['date', 'deliverydate'];

public function user()
{
    return $this->belongsTo(User::class);
}

public function orderItems(): HasMany
{
    return $this->hasMany(Orderitem::class, 'order_id','id');

}

}

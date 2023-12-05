<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantModel extends Model
{
    use HasFactory;
    protected $table='restaurant';
    protected $fillable=['category_id','image','coverimage','name','slug','address','map','phone','email','openninghours','deliverytime','status'];

public function category()
{
    return $this->belongsTo(RestaurantCategory::class,'category_id');
}

}

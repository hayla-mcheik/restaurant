<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    use HasFactory;
    protected $table='gallery';
    protected $fillable=['restaurant_id','image'];

    public function restaurant()
    {
        return $this->belongsTo(RestaurantModel::class, 'restaurant_id');
    }
}

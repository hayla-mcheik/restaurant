<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\RestaurantCategory;
use App\Models\MenuCategories;
use App\Models\MenuItems;
use App\Models\GalleryModel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
$admin = User::create([
    'name' => 'Roy',
    'email' => 'abouzeidroyadmin@gmail.com',
    'password' => 'roy123456',
    'phone' => '12345678',
    'info' => 'description',
    'status'=> 'active',
    'role_as' => 1
]);

$manager = User::create([
    'name' => 'Roymanager',
    'email' => 'abouzeidroymanager@gmail.com',
    'password' => 'roy123456',
    'phone' => '12345678',
    'info' => 'description',
    'status'=> 'active',
    'role_as' => 2  
]);


$user = User::create([
    'name' => 'Royuser',
    'email' => 'abouzeidroyuser@gmail.com',
    'password' => 'roy123456',
    'phone' => '12345678',
    'info' => 'description',
    'status'=> 'active',
    'role_as' => 3  
]);

$restaurantcategory= RestaurantCategory::create([
'name' => 'foodhome',
'slug' => 'foodhome',
'status' => 0,
'image' => 'upload/restaurant/menucategories/170436126533871.png'
]);


$menucategory = MenuCategories::create([
    'restaurant_id' => 1,
    'name' => 'menucategories',
    'status' => 0 ,
    'slug' => 'menucategories',
    'image' => 'upload/restaurant/menucategories/170436126533871.png'
]);

$menuitems= MenuItems::create([
    'menu_category_id' => 1,
    'name' => 'burgerking',
    'slug' => 'burgerking',
    'quantity' => 5,
    'price' => 20,
    'image' => 'upload/restaurant/menucategories/170436126533871.png'
]);

$gallery = GalleryModel::create([
    'restaurant_id' => 1,
    'image' => 'upload/restaurant/menucategories/170436126533871.png'
]);


    }
}

<?php

namespace App\Livewire\Frontend\Restaurant;
use App\Models\RestaurantModel;
use Livewire\Component;
use App\Models\RestaurantCategory;
class Index extends Component
{
    public $categories, $restaurant , $restaurants, $selectedCategories = [];
    public $allCategories = false;
    protected $queryString = [
        'selectedCategories' => ['except' => '', 'as' => 'category'],
    ];



public function updateAllCategories()
{
    $allrestaurants= RestaurantModel::where('status', '0')->get();
    $this->selectedCategories = [];

}
    public function updateCategoryRestaurant(int $categoryId)
    {

        $this->selectedCategories = [$categoryId];

        $this->updateRestaurants();
    }

    public function updateRestaurants()
    {
        $query = RestaurantModel::where('status', '0');

        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        $this->restaurants = $query->get();
    }


    public function render()
    {
        $this->allcategories = RestaurantCategory::where('status','0')->get();
        $this->updateRestaurants();

        return view('livewire.frontend.restaurant.index', [
            'restaurants' => $this->restaurants,
            'categories' => $this->categories,
        ]);
    }
}

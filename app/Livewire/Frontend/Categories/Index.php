<?php

namespace App\Livewire\Frontend\Categories;

use Livewire\Component;
use App\Models\RestaurantCategory;
class Index extends Component
{
    public function render()
    {
        $allcategories = RestaurantCategory::where('status','0')->get();
        return view('livewire.frontend.categories.index',[
            'allcategories' => $allcategories
        ]);
    }
}

<div class="row">
    <div class="col-md-3">
       <div class="filters shadow-sm rounded bg-white mb-4">
          <div class="filters-header border-bottom pl-4 pr-4 pt-3 pb-3">
             <h5 class="m-0">Filter By</h5>
          </div>
          <div class="filters-body">
             <div id="accordion">
                       <div class="filters-card p-4">
                   <div class="filters-card-header" id="headingCategory">
                      <h6 class="mb-0">
                         <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
                         Category <i class="icofont-arrow-down float-right"></i>
                         </a>
                      </h6>
                   </div>
                   <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordion">
                     <div class="filters-card-body card-shop-filters">
                        @if($categories)
                        <div class="custom-control custom-checkbox">
                           <input
                               type="radio"
                               class="custom-control-input"
                               id="cbAllCategories"
                               wire:model="allCategories"
                               wire:click="updateAllCategories"
                           >
                           <label class="custom-control-label" for="cbAllCategories">
                               All Categories
                           </label>
                       </div>
                            @foreach($categories as $category)
                            
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="radio"
                                        class="custom-control-input"
                                        id="cb{{ $category->id }}"
                                        wire:model="selectedCategories" value="{{ $category->id }}"
                                        wire:click="updateCategoryRestaurant('{{ $category->id }}')"
                                    >
                                    <label class="custom-control-label" for="cb{{ $category->id }}">
                                        {{ $category->name }}
                                        <small class="text-black-50">{{ $category->restaurant_count }}</small>
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="col-md-9">
<livewire:frontend.categories.index  />
       <div class="row">
         @foreach($restaurants as $res)
          <div class="col-md-4 col-sm-6 mb-4 pb-2">
             <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                <div class="list-card-image">
                   <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
              
                   <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                     <a href="{{ url('/listing/restaurant/details/'.$res->id) }}">
                   <img src="{{ asset($res->image) }}" class="img-fluid item-img">
                   </a>
                </div>
                <div class="p-3 position-relative">
                   <div class="list-card-body">
                      <h6 class="mb-1"><a  href="{{ url('/listing/restaurant/details/'.$res->id) }}" class="text-black">{{ $res->name }}</a></h6>
                      <p class="text-gray mb-3">{{ $res->address }}</p>
                   </div>
                </div>
             </div>
          </div>
          @endforeach
       </div>
    </div>
 </div>

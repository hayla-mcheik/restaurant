
@extends('layouts.app')

@section('content')

<section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">

    <h1 class="text-white">All Restaurants</h1>
    <h6 class="text-white-50">Best deals at your favourite restaurants</h6>
 </section>
 <section class="section pt-5 pb-5 products-listing">
    <div class="container">
       <div class="row d-none-m">
          <div class="col-md-12">
             <h4 class="font-weight-bold mt-0 mb-3">Restaurant <small class="h6 mb-0 ml-2">{{ $restaurant->count()}}
                </small>
             </h4>
          </div>
       </div>

<livewire:frontend.restaurant.index :categories="$categories" />

    </div>
    </div>
 </section>

 <script>
   document.addEventListener('DOMContentLoaded', function() {

   });
</script>


 @endsection


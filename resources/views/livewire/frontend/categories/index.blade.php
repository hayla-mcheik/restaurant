<div class="owl-carousel owl-carousel-category owl-theme mb-4">
    @foreach ($allcategories as $category)
    <div class="item">
        <div class="osahan-category-item">
            <a href="#">
                <img class="img-fluid" src="{{ asset($category->image) }}" alt="">
                <h6>{{ $category->name }}</h6>
                <p>{{ $category->restaurant_count }} restaurants</p>
            </a>
        </div>
    </div>
@endforeach
  </div>
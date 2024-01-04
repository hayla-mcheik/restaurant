@extends('layouts.admin.master')

@section('title')
Add Offers
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3>Add New Offer</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('manager/offers') }}">List of Offers</a></li>
                <li class="breadcrumb-item active">Create Offer</li>
            </ol>
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('manager.offers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                                <div class="col-md-6">
                <div class="mb-3">
                    <label for="menu_category_id">Menu Category*</label>
                    <select class="form-control" name="menu_category_id" id="menu_category_id">
                        <option value="">Select Category</option>
                        @foreach ($menuCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="menu_items">Menu Items*(Please choose at least 2 menu items)</label>
                    <select class="form-control" name="menu_items[]" id="menu_items" multiple>
                    </select>
                </div>
            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Name*</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"/>
                                    @error('name') <small>{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Discount Type*</label>
                                    <select class="form-control" name="discount_type">
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed_amount">Fixed Amount</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Discount Value*</label>
                                    <input type="number" name="discount_value" value="{{ old('discount_value') }}" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>Start Date*</label>
                                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>End Date*</label>
                                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control"/>
                                </div>
                   
                            </div>
                            <div class="mb-3">
                                <label for="image">Image*</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @error('image') <small>{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Published*</label>
                                    <input type="checkbox" name="is_published" checked/>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success float-end">
                                    <i class="feather-send"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('menu_category_id').addEventListener('change', function() {
            const categoryId = this.value;
            fetch(`/manager/offers/get-menu-items/${categoryId}`,{
                method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
                body: JSON.stringify({ categoryId })
            })
            .then(response => response.json())
            .then(response => {
                const menuItemsSelect = document.getElementById('menu_items');
                menuItemsSelect.innerHTML = ''; 

                response.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.name;
                    menuItemsSelect.appendChild(option);
                });

                console.log('Menu items populated successfully!');
            })
            .catch(error => {
                console.error('Failed to load menu items:', error);
                alert('Failed to load menu items. Please try again.');
            });
        });
    });
</script>



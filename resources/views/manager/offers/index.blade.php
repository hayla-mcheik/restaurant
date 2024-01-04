@extends('layouts.admin.master')

@section('title')
List of Offers
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3>List of Offers
                <a href="{{ route('manager.offers.create') }}" class="btn btn-primary btn-sm float-end">
                    Add Offer
                </a>
            </h3>

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ url('manager/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">List of Offers</li>
            </ol>

            <div class="card">
                <div class="card-body">

                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Menu Items</th>
                                <th>Name</th>
                                <th>Discount Value</th>
                                <th>Published</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($offers as $offer)
                                <tr>
                                    <td>{{ $offer->id }}</td>
                                    <td>
                                        @foreach ($offer->menuItems as $item)
                                            {{ $item->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $offer->name }}</td>
                                    <td>{{ $offer->discount_value }}</td>
                                    <td>{{ $offer->is_published ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('manager.offers.edit', $offer->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('manager.offers.destroy', $offer->id) }}" onclick="return confirm('Are you sure you want to delete this offer?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">No Offers Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

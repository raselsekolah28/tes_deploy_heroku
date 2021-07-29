@extends('template.template')

@section('title-product')
    Products
@endsection

@section('title')
    Products
@endsection

@section('content')
    <div class="row mb-3">
        <a href="{{ route("products.create") }}">
            <button class="btn btn-primary">Add Product</button>
        </a>
    </div>
    <div class="row">
        @if (session("success"))
            <div class="alert alert-success" role="alert">
                {{ session("success") }}
            </div>
        @endif
    </div>
    <div class="row mb-3">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Categorie</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->categorie->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <img src="{{ asset($item->image) }}" width="100px" alt="">
                        </td>
                        <td>
                            <form action="{{ route("products.destroy", $item) }}" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route("products.edit", $item) }}">
                                <button class="btn btn-warning">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        {{ $products->links() }}
    </div>
@endsection
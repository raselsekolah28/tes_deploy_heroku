@extends('template.template')

@section('title-product')
    {{ $product->name }}
@endsection

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>
    <form action="{{ route("products.update", $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("patch")

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ $product->name }}">
        </div>
        <div class="form-group">
            <label for="categorie_id">Categorie</label>
            <select id="categorie_id" class="form-control" name="categorie_id">
                <option value="">Choose Categorie</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{ ($product->categorie->id === $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" rows="3">
                {{ $product->description }}
            </textarea>
        </div>
        <div class="form-group">
            <label for="price">price</label>
            <input id="price" class="form-control" type="number" min="0" name="price" value="{{ $product->price }}">
        </div>
        <div class="form-group">
            <img src="{{ asset($product->image) }}" width="100px" alt="">
            <br>
            <label for="image">image</label>
            <input id="image" class="form-control" type="file" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Edit Product</button>
    </form>
@endsection
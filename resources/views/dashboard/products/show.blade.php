@extends('template.template')

@section('title-page')
    {{ $product->name }}
@endsection

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($product->image) }}" width="100%" alt="">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <div class="d-flex align-items-center justify-content-between mt-2">
                <span class="badge badge-primary">{{ $product->categorie->name }}</span>
                <h6>Rp{{ number_format($product->price) }}</h6>
            </div>
            <p class="mt-3">{{ $product->description }}</p>
            <hr style="height: 2px; width: 100%">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route("cart.add", $product->id) }}" method="POST">
                @csrf
                <input type="number" min="0" class="form-control" placeholder="qty" name="qty">
                <button type="submit" class="btn btn-primary mt-3">Add to cart</button>
            </form>
        </div>
    </div>

    @if (session("success"))
        <script>
            alert("{{ session("success") }}");
        </script>
    @endif
@endsection
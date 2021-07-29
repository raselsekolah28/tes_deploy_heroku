@extends('template.template')

@section('title-page')
    Dashboard
@endsection

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Welcome back</h4>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta aspernatur ipsa ipsam saepe molestiae sint laborum officiis pariatur labore ratione! Mollitia error vero amet reprehenderit quae. Pariatur neque repudiandae a?
        </div>
    </div>
    @if (Auth::user()->role_id === 2)
        <div class="row">
            <hr style="height: 1px; width: 100%">
        </div>
        <div class="row">
            <h3>Product Available</h3>
        </div>
        <div class="row">
            <form action="{{ route("dashboard") }}" method="GET" class="d-flex my-4">
                <input type="text" name="search" class="form-control" placeholder="Search products..">
                <button type="submit" class="btn btn-primary ml-2">Search</button>
            </form>
        </div>
        <div class="row">
            @foreach ($products as $item)
                <div class="col-md-4">
                    <img src="{{ asset($item->image) }}" width="100%" alt="">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <span class="badge badge-primary">{{ $item->categorie->name }}</span>
                        <h6>Rp{{ number_format($item->price) }}</h6>
                    </div>
                    <h4 class="mt-2">{{ $item->name }}</h4>
                    <a href="{{ route("products.detail", $item->id) }}">
                        <button class="btn btn-primary mt-3">More Detail</button>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection
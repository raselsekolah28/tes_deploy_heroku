@extends('template.template')

@section('title-page')
    Checkout
@endsection

@section('title')
    Checkout
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Product Cart</h3>
            <hr style="width: 100%; height: 1px">
            @if (sizeof(Auth::user()->carts))
                @foreach (Auth::user()->carts as $item)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>{{ $item->product->name }}</h5>
                            <div class="d-flex align-items-start justify-content-between">
                                <h6>Rp{{ number_format($item->product->price) }} * {{ $item->qty }}</h6>
                                <span class="badge badge-primary">Rp{{ number_format($item->product->price * $item->qty) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                    Not have product in cart
                </div>
            @endif
            <hr style="width: 100%; height: 1px">
            <div class="d-flex align-items-start justify-content-between">
                <h6>Total</h6>
                <span class="badge badge-warning">Rp{{ number_format(Auth::user()->getTotal()) }}</span>
            </div>
            <form action="{{ route("checkout.store") }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary mt-4">Checkout Now</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Recent Checkout</h3>
            <hr style="width: 100%; height: 1px">
            @if (sizeof(Auth::user()->transactions))
                @foreach (Auth::user()->transactions as $item)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>{{ $item->code_transaction }}</h5>
                            <div class="d-flex align-items-start justify-content-between">
                                <h6>Checkout at :</h6>
                                <span class="badge badge-dark">{{ $item->date }}</span>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h6>Name Product :</h6>
                                    <span >{{ $item->detail[0]->product->name }}</span>
                                </div>
                                <div class="d-flex align-items-start justify-content-between">
                                    <h6>Categorie Product :</h6>
                                    <span >{{ $item->detail[0]->product->categorie->name }}</span>
                                </div>
                                <div class="d-flex align-items-start justify-content-between">
                                    <h6>Price Product :</h6>
                                    <span >Rp{{ number_format($item->detail[0]->product->price) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                    Not have product in cart
                </div>
            @endif
        </div>
    </div>

    @if (session("success"))
        <script>
            alert("{{ session("success") }}")
        </script>
    @endif
@endsection
@extends('template.template')

@section('title-page')
    Transaction
@endsection

@section("title")
    Transaction
@endsection

@section('content')
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Code Transaction</th>
                <th>Date</th>
                <th>Customer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->code_transaction }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->customer->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
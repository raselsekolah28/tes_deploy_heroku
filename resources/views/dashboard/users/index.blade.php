@extends('template.template')

@section('title-page')
    Users
@endsection

@section('title')
    Users
@endsection

@section('content')
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
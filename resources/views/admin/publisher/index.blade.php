@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Publishers</h1>
        <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary">Add Publisher</a>


        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Book Count</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($publishers as $publisher)
                <tr>
                    <td>{{ $publisher->name }}</td>
                    <td>{{ $publisher->email }}</td>
                    <td>{{ $publisher->address }}</td>
                    <td>{{ $publisher->phone }}</td>
                    <td>{{ count($publisher->books) }}</td>
                    <td>
                        <a href="{{ route('admin.publishers.edit', $publisher->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('publishers.show', $publisher->id) }}" class="btn btn-primary">Details</a>
                        <form action="{{ route('admin.publishers.destroy', $publisher->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                <tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

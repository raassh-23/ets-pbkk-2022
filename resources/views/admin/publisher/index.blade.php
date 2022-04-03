@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Manage Publishers</h1>
            <div>
                <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary">Add Publisher</a>
            </div>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table">
            <thead>
                <th>No</th>
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $publisher->name }}</td>
                        <td>{{ $publisher->email }}</td>
                        <td>{{ $publisher->address }}</td>
                        <td>{{ $publisher->phone }}</td>
                        <td>{{ count($publisher->books) }}</td>
                        <td>
                            <a href="{{ route('publishers.show', $publisher->id) }}" class="btn btn-primary">Details</a>
                            <a href="{{ route('admin.publishers.edit', $publisher->id) }}" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                            if(confirm('Are you sure?')) document.getElementById('{{ 'delete-form'.$publisher->id }}').submit();">Delete</a>
                            <form action="{{ route('admin.publishers.destroy', $publisher->id) }}" id="{{ 'delete-form'.$publisher->id }}" class="d-none" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

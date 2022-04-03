@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Manage Category</h1>
            <div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
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
                <th>Category Name</th>
                <th># Books</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->books->count() }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                            if(confirm('Are you sure?')) document.getElementById('{{ 'delete-form'.$category->id }}').submit();">Delete</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" id="{{ 'delete-form'.$category->id }}" class="d-none" method="POST">
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

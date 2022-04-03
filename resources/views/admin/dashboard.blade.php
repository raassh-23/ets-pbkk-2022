@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Manage Categories</a>
        <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Manage Books</a>
        <a href="{{ route('admin.publishers.index') }}" class="btn btn-primary">Manage Publishers</a>
        <a href="{{ route('admin.writers.index') }}" class="btn btn-primary">Manage Writers</a>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-primary">Manage Reviews</a>
    </div>
@endsection

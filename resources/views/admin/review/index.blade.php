@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Review</h1>

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
                <th>User</th>
                <th>Book</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->book->title }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->review }}</td>
                        <td>
                            <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('{{ 'delete-form'.$review->id }}').submit();">Delete</a>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" id="{{ 'delete-form'.$review->id }}" class="d-none" method="POST">
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

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Review</h1>

        <table>
            <thead>
                <th>User</th>
                <th>Book</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->book->title }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->review }}</td>
                    <td>
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST">
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

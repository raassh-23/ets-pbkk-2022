@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-row">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}'s avatar" width="200px" height="200px">
            <div class="d-flex flex-column ms-3 mt-1">
                <h6 class="text-primary mb-0">USER</h6>
                <h1 class="fw-bolder">{{ $user->name }}</h1>
                <p class="mb-1"><b>Email</b> {{ $user->email }}</p>
            </div>
        </div>

        <h2 class="mt-4">Reviews ({{ count($user->reviews) ?: 0 }})</h2>
        @foreach ($user->reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <a class="fw-bold fs-4" href="{{ route('users.show', ['user' => $review->user->id]) }}">{{ $review->user->name }}</a>
                    <div class="d-flex flex-row">
                        <span style="color: Orange;">
                            <i class="fas fa-star fa-large"></i>
                        </span>
                        <p class="ms-1 mb-0">{{ round($review->rating, 2) ?: '-'}}</p>
                    </div>
                    <p  class="my-0">{{ $review->review }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

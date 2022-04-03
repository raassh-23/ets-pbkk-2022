@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        <div class="d-flex">
            <div class="col-md-10">
                @if (count($users) > 0)
                    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        @foreach ($users as $user)
                            <div class="col position-relative">
                                <div class="card h-100">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img class="img-fluid rounded-start" src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                                style="width:100%">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <a class="card-title fw-bold fs-5 stretched-link text-black text-decoration-none m-0"
                                                    href="{{ route('users.show', ['user' => $user->id]) }}">{{ Str::limit($user->name, 30, '...') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h3 class="text-center">No users found.</h3>
                @endif
            </div>
            <div class="col-md-2 ms-3">
                <h2>Search</h2>
                <form method="GET" action="{{ route('users.index') }}">
                    <div class="d-flex flex-row">
                        <input type="text" class="form-control" placeholder="Search users..." name="search"
                            value="{{ request()->search }}">
                        <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
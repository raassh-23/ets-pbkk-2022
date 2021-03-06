@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-3 g-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title fw-bold">Users</h4>
                                <h5>Count: <b>{{ $usersCount }}</b></h5>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-user fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title fw-bold">Categories</h4>
                                <h5>Count: <b>{{ $categoriesCount }}</b></h5>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Manage</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-list fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title fw-bold">Books</h4>
                                <h5>Count: <b>{{ $booksCount }}</b></h5>
                                <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Manage</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-book fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title fw-bold">Publishers</h4>
                                <h5>Count: <b>{{ $publishersCount }}</b></h5>
                                <a href="{{ route('admin.publishers.index') }}" class="btn btn-primary">Manage</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-building fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title fw-bold">Writers</h4>
                                <h5>Count: <b>{{ $writersCount }}</b></h5>
                                <a href="{{ route('admin.writers.index') }}" class="btn btn-primary">Manage</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-keyboard fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title fw-bold">Reviews</h4>
                                <h5>Count: <b>{{ $reviewsCount }}</b></h5>
                                <a href="{{ route('admin.reviews.index') }}" class="btn btn-primary">Manage</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-star fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

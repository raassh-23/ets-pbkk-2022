@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Publishers</h1>
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            @foreach ($publishers as $publisher)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $publisher->name }}</h4>
                            </div>
                            <a href="{{ url('/publisher/'.$publisher->id) }}" class="btn btn-primary mt-2">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
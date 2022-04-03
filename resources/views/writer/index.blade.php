@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Writers</h1>
        <div class="d-flex">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                @foreach ($writers as $writer)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <img src="{{ $writer->image_url }}" alt="{{ $writer->name }}'s image" width="250px" height="330px">
                                <div>
                                    <h4 class="card-title">{{ $writer->name }}</h4>
                                </div>
                                <a href="{{ route('writers.show', ['writer' => $writer->id]) }}" class="btn btn-primary mt-2">Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-2 ms-3">
                <h2>Search</h2>
                <form method="GET" action="{{ route('writers.index') }}">
                    <div class="d-flex flex-row">
                        <input type="text" class="form-control" placeholder="Search writers..." name="search">
                        <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
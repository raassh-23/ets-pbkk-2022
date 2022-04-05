@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Publisher</h1>

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

        <form class="row gy-3 p-3 border rounded-3 border-2 bg-white mt-3" action="{{ route('admin.publishers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12 form-group">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-12 form-group">
                <label class="form-label" for="address">Adrress</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="phone">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add Publisher</button>
            </div>
        </form>
    </div>
@endsection

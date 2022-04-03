@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Writer</h1>

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

        <form action="{{ route('admin.writers.update', ['writer' => $writer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $writer->name }}" required>
            </div>
            <div class="form-group">
                <label for="address">Adrress</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $writer->address }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $writer->email }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $writer->phone }}" required>
            </div>
            <div class="form-group">
                <img src="{{ $writer->image_url }}" alt="{{ $writer->name }}" width="100">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

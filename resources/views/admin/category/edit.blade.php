@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Category</h1>

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

        <form class="row gy-3 p-3 border rounded-3 border-2 bg-white mt-3" action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col form-group m-0">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
            </div>
            <div class="col-12">
                <button type="submit" class="form-button btn btn-primary">Edit category</button>
            </div>
        </form>
    </div>
@endsection

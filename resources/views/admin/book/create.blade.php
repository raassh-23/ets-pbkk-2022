@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Book</h1>

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

        <form class="row gy-3 p-3 border rounded-3 border-2 bg-white mt-3" action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12 form-group">
                <label class="form-label" for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="col-12 form-group">
                <label class="form-label" for="synopsis">Synopsis</label>
                <textarea class="form-control" id="synopsis" rows="3" name="synopsis" required></textarea>
            </div>
            <div class="col-3 form-group">
                <label class="form-label" for="edition">Edition</label>
                <input type="number" class="form-control" id="edition" name="edition" required>
            </div>
            <div class="col-3 form-group">
                <label class="form-label" for="publish_year">Published Year</label>
                <input type="number" class="form-control" id="publish_year" name="publish_year" required>
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="isbn">ISBN</label>
                <input type="number" class="form-control" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="cover_image">Cover Image</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="writer_id">Writer(s)</label>
                <select multiple class="form-select" id="writer_id" name="writer_id[]" required>
                    @foreach ($writers as $writer)
                        <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="publisher_id">Publisher</label>
                <select class="form-select" id="publisher_id" name="publisher_id" required>
                    <option value="0">Select Publisher</option>
                    @foreach ($publishers as $publisher)
                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="category_id">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="0">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add book</button>
            </div>
        </form>
    </div>
@endsection

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
            <div class="alert alert-error">
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

        <form action="{{ route('admin.books.update', ['book' => $book->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea class="form-control" id="synopsis" rows="3" name="synopsis" required>{{ $book->synopsis }}</textarea>
            </div>
            <div class="form-group">
                <label for="edition">Edition</label>
                <input type="number" class="form-control" id="edition" name="edition" value="{{ $book->edition }}" required>
            </div>
            <div class="form-group">
                <label for="publish_year">Published Year</label>
                <input type="number" class="form-control" id="publish_year" name="publish_year" value="{{ $book->publish_year }}" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="number" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
            </div>
            <div class="form-group">
                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" width="100">
                <label for="cover_image">Cover Image</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image">
            </div>
            <div class="form-group">
                <label for="writer_id">Writer(s)</label>
                <select multiple class="form-control" id="writer_id" name="writer_id[]" required>
                    @foreach ($writers as $writer)
                        <option value="{{ $writer->id }}" @if ($book->writers->contains($writer->id)) selected @endif>{{ $writer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="publisher_id">Publisher</label>
                <select class="form-control" id="publisher_id" name="publisher_id" required>
                    <option value="0">Select Publisher</option>
                    @foreach ($publishers as $publisher)
                        <option value="{{ $publisher->id }}" @if ($book->publisher->id == $publisher->id) selected @endif>{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="0">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($book->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
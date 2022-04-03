@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Writer</h1>
        <a href="{{ route('admin.writers.create') }}" class="btn btn-primary">Add Writer</a>

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

        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Book Count</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($writers as $writer)
                    <tr>
                        <td>{{ $writer->name }}</td>
                        <td>{{ $writer->email }}</td>
                        <td>{{ count($writer->books) }}</td>
                        <td>
                            <a href="{{ route('admin.writers.edit', $writer->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('writers.show', $writer->id) }}" class="btn btn-primary">Details</a>
                            <form action="{{ route('admin.writers.destroy', $writer->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

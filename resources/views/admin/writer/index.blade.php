@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Manage Writer</h1>
            <div>
                <a href="{{ route('admin.writers.create') }}" class="btn btn-primary">Add Writer</a>
            </div>
        </div>
        
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

        <table class="table">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Book Count</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($writers as $writer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $writer->name }}</td>
                        <td>{{ $writer->email }}</td>
                        <td>{{ count($writer->books) }}</td>
                        <td>
                            <a href="{{ route('writers.show', $writer->id) }}" class="btn btn-primary">Details</a>
                            <a href="{{ route('admin.writers.edit', $writer->id) }}" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                            if(confirm('Are you sure?')) document.getElementById('{{ 'delete-form'.$writer->id }}').submit();">Delete</a>
                            <form action="{{ route('admin.writers.destroy', $writer->id) }}" id="{{ 'delete-form'.$writer->id }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

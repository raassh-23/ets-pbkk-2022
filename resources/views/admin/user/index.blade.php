@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Users</h1>

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
                <th>Role</th>
                <th>Review Count</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role == 0 ? 'User' : 'Admin' }}</td>
                        <td>{{ count($user->reviews) }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Details</a>
                            <a href="#" class="btn btn-warning" onclick="event.preventDefault();
                            document.getElementById('{{'update-form'.$user->id}}').submit();">{{ $user->role == 0 ? 'Promote to admin' : 'Demote to user' }}</a>
                            <form action="{{ route('admin.users.update', $user->id) }}" id="{{'update-form'.$user->id}}" class="d-none" method="POST">
                                @csrf
                                @method('PUT')
                            </form>
                            <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('{{'delete-form'.$user->id}}').submit();">Delete</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" id="{{'delete-form'.$user->id}}" class="d-none" method="POST">
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

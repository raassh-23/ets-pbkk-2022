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

        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Review Count</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role == 0 ? 'User' : 'Admin' }}</td>
                        <td>{{ count($user->reviews) }}</td>
                        <td>
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button
                                    class="btn btn-warning">{{ $user->role == 0 ? 'Promote to admin' : 'Demote to user' }}</button>
                            </form>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Details</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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

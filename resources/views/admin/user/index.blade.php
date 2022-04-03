@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Books</h1>

        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Review Count</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ count($user->reviews) }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
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

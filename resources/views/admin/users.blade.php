@extends('admin.layout')

@section('page_title', 'User Management')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Manage Users</h2>
        
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Name</th>
                    <th class="py-2 px-4 border-b text-left">Email</th>
                    <th class="py-2 px-4 border-b text-left">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">
                         <form action="{{ route('admin.users.update_role', $user) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <select name="role" class="border rounded-md px-2 py-1" onchange="this.form.submit()">
                                <option value="user" @if($user->role === 'user') selected @endif>User</option>
                                <option value="vendor" @if($user->role === 'vendor') selected @endif>Vendor</option>
                                <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
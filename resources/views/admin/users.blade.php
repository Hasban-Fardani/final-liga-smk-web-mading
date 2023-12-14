<!-- The only way to do great work is to love what you do. - Steve Jobs -->
@extends('layout.admin')
@section('content')
    <div class="px-6 py-3">
        <h2 class="text-3xl font-medium">Users</h2>
        <div class="border-t-2 border-gray-300 mb-6"></div>

        <div class="overflow-x-scroll">
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Type</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="flex justify-center"><img src="{{ $user->avatar }}" alt="{{ $user->username }}" width="50" height="50" class="p-1"></td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->type }}</td>
                        <td>{{ $user->permission }}</td>
                        <td>
                            <button>an action</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
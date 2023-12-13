<!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
@extends('layout.app')
 
@section('content')
    <table id="dataTable" name="users">
        <thead>
            <tr>
                <td>Id</td>    
                <td>username</td>    
                <td>email</td>    
            </tr>    
        </thead>    
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>    
@endsection
 
@push('js')
@endpush

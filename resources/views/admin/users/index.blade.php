@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User Management</div>

                <div class="card-body">
                          
                   <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                            <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td>
                            @can('super-admin')
                           <a href="{{ route('admin.users.edit', $user->id) }}"> <button type="button" class="btn btn-primary float-left">Edit</button></a>
                           @endcan

                           @can('super-admin')
                          <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left"> 
                           @csrf
                           {{ method_field('DELETE') }}
                           &nbsp<button type="submit" class="btn btn-danger">Delete</button>
                           @endcan
                           </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

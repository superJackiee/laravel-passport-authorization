@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Welcome! </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('roles.create') }}" title="Create a Role"> <i class="fas fa-plus-circle">Create</i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
        
            <th>No</th>
            <th>Name</th>
            <th>app_id</th>
            <th>team_id</th>
            <th>user_id</th>

            <th>Actions</th>
        </tr>
        @foreach ($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->app_id}}</td>
                <td>{{$role->team_id}}</td>
                <td>{{$role->user_id}}</td>

                <td>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">

                        <a href="" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger">Delete</i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $roles->links() !!}

@endsection
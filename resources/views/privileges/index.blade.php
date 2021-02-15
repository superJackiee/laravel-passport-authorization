@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Welcome! </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('privileges.create') }}" title="Create a Privilege"> <i class="fas fa-plus-circle">Create</i>
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
            <th>Actions</th>
        </tr>
        @foreach ($privileges as $privilege)
            <tr>
                <td>{{$privilege->id}}</td>
                <td>{{$privilege->name}}</td>
                <td>
                    <form action="{{ route('privileges.destroy', $privilege->id) }}" method="POST">

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

    {!! $privileges->links() !!}

@endsection
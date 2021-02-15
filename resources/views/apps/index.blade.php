@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Welcome! </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('apps.create') }}" title="Create a Team"> <i class="fas fa-plus-circle">Create</i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>Success!</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
        
            <th>No</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        @foreach ($apps as $app)
            <tr>
                <td>{{$app->id}}</td>
                <td>{{$app->name}}</td>
                <td>
                    <form action="{{ route('apps.destroy', $app->id) }}" method="POST">

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

    {!! $apps->links() !!}

@endsection
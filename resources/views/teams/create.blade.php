@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Team</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('teams.index') }}" title="Go back"> <i class="fas fa-backward "></i> Go back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> 
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('teams.store') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>MaxMembers:</strong>
                    <input type="number" name="maxmembers" class="form-control" placeholder="Put the MaxMembers">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>parent_team:</strong>
                    <div class="select">
                        <select name="parent_team" required class="form-control">
                        <option value="" disabled selected>Select Team</option>
                        @foreach($teams as $team)
                            
                            <option value="{{$team->id}}">{{$team->name}}</option>
                            
                        @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
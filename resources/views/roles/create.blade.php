@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}" title="Go back"> <i class="fas fa-backward "></i> Go back</a>
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
    <form action="{{ route('roles.store') }}" method="POST" >
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
                    <strong>app_id:</strong>
                    <div class="select">
                        <select name="app_id" required class="form-control">
                        <option value="" disabled selected>Select App</option>
                        @foreach($apps as $app)
                            
                            <option value="{{$app->id}}">{{$app->name}}</option>
                            
                        @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>team_id:</strong>
                    <div class="select">
                        <select name="team_id" required class="form-control">
                        <option value="" disabled selected>Select Team</option>
                        @foreach($teams as $team)
                            
                            <option value="{{$team->id}}">{{$team->name}}</option>
                            
                        @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>user_id:</strong>
                    <div class="select">
                        <select name="user_id" required class="form-control">
                        <option value="" disabled selected>Select User</option>
                        @foreach($users as $user)
                            
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            
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
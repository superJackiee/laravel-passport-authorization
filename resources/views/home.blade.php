<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                      
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ "user" }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" 
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ URL::to('logout')}}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <style>
            body {
            margin: 0;
            font-family: "Lato", sans-serif;
            }

            .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
            }

            .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
            }
            
            .sidebar a.active {
            background-color: #4CAF50;
            color: white;
            }

            .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
            }

            div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
            }

            table {
            width:100%;
            }
            table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            }
            th, td {
            padding: 15px;
            text-align: left;
            }
            #t01 tr:nth-child(even) {
            background-color: #eee;
            }
            #t01 tr:nth-child(odd) {
            background-color: #fff;
            }
            #t01 th {
            background-color: black;
            color: white;
            }

            @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar a {float: left;}
            div.content {margin-left: 0;}
            }

            @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
            }
            .btn{
                margin-right: 10px;
            }
            </style>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <button class="btn btn-primary teams">Teams</button>
                        <button class="btn btn-primary roles">Roles</button>
                        <button class="btn btn-primary apps">Apps</buttossn>
                        <button class="btn btn-primary privileges">Privileges</button>
                        <button class="btn btn-primary resetPass" style="float: right;">Reset Password</button>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Dashboard</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                
                                <!-- You are logged in! -->
                                <div class="sidebar">
                                <a class="active" href="#home">Teams</a>
                                <a href="#news">Apps</a>
                                <a href="#contact">Roles</a>
                                <a href="#about">Privileges</a>
                                </div>

                                <div class="content">
                                <h2>Team Management</h2>
                                <button class="btn btn-primary">Create Team</button>
                                <p></p>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $('.teams').click(function () {
                    const token = localStorage.getItem('token')
                    if (!token) {
                        alert("You are unauthorized user")
                        return
                    }
                    $.ajax({
                        url: '/api/teams/4',
                        type: 'PUT',
                        data: {name: "123", maxmembers: 20, parent_team: 2},
                        headers: {
                            Authorization: 'Bearer ' + token
                        },
                        success: function(response) {
                            console.log('###############', response)
                        }
                    })
                })
                $('.apps').click(function () {
                    const token = localStorage.getItem('token')
                    if (!token) {
                        alert("You are unauthorized user")
                        return
                    }
                    $.ajax({
                        url: '/api/apps/has_permission/fetching',
                        type: 'GET',
                        data: {},
                        headers: {
                            Authorization: 'Bearer ' + token
                        },
                        success: function(response) {
                            console.log('###############', response)
                        }
                    })
                })
                $('.privileges').click(function () {
                    const token = localStorage.getItem('token')
                    if (!token) {
                        alert("You are unauthorized user")
                        return
                    }
                    $.ajax({
                        url: '/api/privileges/has_permission/edit_all',
                        type: 'GET',
                        data: {},
                        headers: {
                            Authorization: 'Bearer ' + token
                        },
                        success: function(response) {
                            console.log('###############', response)
                        }
                    })
                })
                $('.roles').click(function () {
                    const token = localStorage.getItem('token')
                    if (!token) {
                        alert("You are unauthorized user")
                        return
                    }
                    $.ajax({
                        url: '/api/roles',
                        type: 'GET',
                        data: {},
                        headers: {
                            Authorization: 'Bearer ' + token
                        },
                        success: function(response) {
                            console.log('###############', response)
                        }
                    })
                })
                // $('.teams').click(function () {
                //     alert('aaa');
                //     const token = localStorage.getItem('token')
                //     if (!token) {
                //         alert("You are unauthorized user")
                //         return
                //     }
                //     $.ajax({
                //         url: '/api/teams',
                //         type: 'GET',
                //         data: {},
                //         headers: {
                //             Authorization: 'Bearer ' + token
                //         },
                //         success: function(response) {
                //             console.log('###############', response)
                //         }
                //     })
                // })
                $('.resetPass').click(function () {
                    const token = localStorage.getItem('token')
                    if (!token) {
                        alert("You are unauthorized user")
                        return
                    }
                    $.ajax({
                        url: '/api/reset-password',
                        type: 'POST',
                        data: {
                            new_password: '123'
                        },
                        headers: {
                            Authorization: 'Bearer ' + token
                        },
                        success: function(response) {
                            if (response.success)
                                alert("Password Reset Successfully")
                        }
                    })
                })
            </script>
</main>
    </div>
</body>
</html>


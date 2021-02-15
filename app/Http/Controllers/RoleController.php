<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\App;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::latest()->paginate(5);

        foreach($roles as $role)
        {
            $p_app = App::find($role->app_id);
            if(empty($p_app))
                $role->app_id = "no app";
            else
                $role->app_id = $p_app->name;

            $p_team = Team::find($role->team_id);
            if(empty($p_team))
                $role->team_id = "no team";
            else
                $role->team_id = $p_team->name;
            $p_user = User::find($role->user_id);
            if(empty($p_user))
                $role->user_id = "no user";
            else
                $role->user_id = $p_user->name;
        }

        return response()->json($roles);

        // return view('roles.index', compact('roles'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $apps = App::all();
        $teams = Team::all();
        $users = User::all();

        return view('roles.create', compact('apps', 'teams', 'users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'app_id' => 'required',
            'team_id' => 'required',
            'user_id' => 'required'
        ]);

        Role::create($request->all());

        $roles = Role::all();
        

        return response()->json($roles);
            
        // return redirect()->route('roles.index')
        //     ->with('success', 'Role created successfully.');
    }

    public function role_user($user_id, $role_id)
    {


       $role = Role::find($role_id);
       $user = User::find($user_id);

        if(empty($role)||empty($user))
          return response()->json("Error!");


       $user->roles()->attach($role);
       
       return response()->json("success");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(empty($role))
            return response()->json("no data");
        return response()->json($role);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view('roles.edit', compact('role'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $request->validate([
        //     'name' => 'required',
        //     'app_id' => 'required',
        //     'team_id' => 'required',
        //     'user_id' => 'required'

        // ]);
        $role = Role::find($id);
        if(empty($role))
        {
            return response()->json("no such data");
        }

        $role->update($request->all());
        $role = Role::find($id);

        return response()->json($role);
        // return redirect()->route('roles.index')
        //     ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role = Role::find($id);
        if(empty($role))
            return response()->json("no data");
        
        $role->delete();

        return response()->json("success");

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}

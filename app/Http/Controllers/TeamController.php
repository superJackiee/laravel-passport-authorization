<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct() 
    {
        //$this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teams = Team::latest()->paginate(5);
        foreach($teams as $team)
        {
            $p_team = Team::find($team->parent_team);
            if($team->parent_team == 0 || empty($p_team))
                $team->parent_team = "no parent";
            else
                $team->parent_team = $p_team->name;
        }
        
        return response()->json($teams);
        
        // return view('teams.index', compact('teams'))
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
    
        $teams = Team::all();
        return response()->json($teams);
        return view('teams.create', compact('teams'));
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
            'name' => 'required|unique:teams',
            'maxmembers' => 'required',
            'parent_team' => 'required'
        ]);

       $team = Team::create($request->all());
    //    $user = User::where('name','ccc')->first();
    //    $user->teams()->attach($team);
       
       $teams = Team::all();
        

        return response()->json($teams);
        // return redirect()->route('teams.index')
        //     ->with('success', 'Team created successfully.');
    }

    public function team_user($user_id, $team_id)
    {


       $team = Team::find($team_id);
       $user = User::find($user_id);

        if(empty($team)||empty($user))
          return response()->json("Error!");


       $user->teams()->attach($team);
       
       return response()->json("success");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $team = Team::find($id);
        
        if(empty($team))
            return response()->json("no data");
        return response()->json($team);

        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $request->validate([
        //     'name' => 'required',
        //     'maxmembers' => 'required',
        //     'parent_team' => 'required'
        // ]);
        $team = Team::find($id);
        if(empty($team))
        {
            return response()->json("no such data");
        }
        
        $team->update($request->all());
        $team = Team::find($id);

        return response()->json($team);
        // return redirect()->route('teams.index')
        //     ->with('success', 'Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $team = Team::find($id);
        if(empty($team))
            return response()->json("no data");
        
        $team->delete();

        return response()->json("success");
        return redirect()->route('teams.index')
            ->with('success', 'Team deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $apps = App::latest()->paginate(5);
        
        return response()->json($apps);

        // return view('apps.index', compact('apps'))
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
        return response()->json($apps);
        return view('apps.create');
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
        ]);

        App::create($request->all());

        $apps = App::all();
        
        return response()->json($apps);

        // return redirect()->route('apps.index')
        //     ->with('success', 'Team created successfully.');
    }
    public function app_user($user_id, $app_id)
    {


       $app = App::find($app_id);
       $user = User::find($user_id);

        if(empty($app)||empty($user))
          return response()->json("Error!");


       $user->apps()->attach($app);
       
       return response()->json("success");
    }

    public function has_permission($name)
    {
        $app = App::where('name', $name)->first();
        if(empty($app))
            return response()->json("there is no such app");
        return response()->json("authorized user");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $app = App::find($id);
        
        if(empty($app))
            return response()->json("no data");
        return response()->json($app);

        return view('apps.show', compact('app'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function edit(App $app)
    {
        //
        return view('apps.edit', compact('app'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $request->validate([
        //     'name' => 'required',
        // ]);
        $app = App::find($id);
        if(empty($app))
        {
            return response()->json("no such data");
        }

        $app->update($request->all());

        $app = App::find($id);

        return response()->json($app);
        // return redirect()->route('apps.index')
        //     ->with('success', 'Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $app = App::find($id);
        if(empty($app))
            return response()->json("no data");
        
        $app->delete();

        return response()->json("success");

        return redirect()->route('apps.index')
            ->with('success', 'Team deleted successfully');
    }
}

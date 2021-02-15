<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Models\User;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $privileges = Privilege::latest()->paginate(5);
        
        return response()->json($privileges);

        // return view('privileges.index', compact('privileges'))
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
        $privileges = Privilege::all();
        return response()->json($privileges);
        return view('privileges.create');

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

        Privilege::create($request->all());

        $privileges = Privilege::all();
        

        return response()->json($privileges);
        // return redirect()->route('privileges.index')
        //     ->with('success', 'Previlege created successfully.');
    }

    public function privilege_user($user_id, $privilege_id)
    {


       $privilege = Privilege::find($privilege_id);
       $user = User::find($user_id);

        if(empty($privilege)||empty($user))
          return response()->json("Error!");


       $user->privileges()->attach($privilege);
       
       return response()->json("success");
    }
    public function has_permission($name)
    {
        $privilege = Privilege::where('name', $name)->first();
        if(empty($privilege))
            return response()->json("there is no such privilege");
        return response()->json("authorized user");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $privilege = Privilege::find($id);
        
        if(empty($privilege))
            return response()->json("no data");
        return response()->json($privilege);

        return view('privileges.show', compact('privilege'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function edit(Privilege $privilege)
    {
        //
        return view('privileges.edit', compact('privilege'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $request->validate([
        //     'name' => 'required',
        // ]);
        $privilege = Privilege::find($id);
        if(empty($privilege))
        {
            return response()->json("no such data");
        }

        $privilege->update($request->all());
        $privilege = Privilege::find($id);

        return response()->json($privilege);

        // return redirect()->route('privileges.index')
        //     ->with('success', 'Privilege updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $privilege = Privilege::find($id);
        if(empty($privilege))
            return response()->json("no data");
        $privilege->delete();

        return response()->json("success");

        return redirect()->route('privileges.index')
            ->with('success', 'Privilege deleted successfully');
    }
}

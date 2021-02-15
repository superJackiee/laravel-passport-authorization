<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;

use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register',]]);
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);
        
        $team = Team::where('name','web')->first();
        $user->teams()->attach($team);

        $accessToken = $user->createToken('authToken')->accessToken;

    //    return redirect('home');

        return response(['user' => $user, 'access_token' => $accessToken], 201);
    }
   
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (!$token = auth()->attempt($loginData)) {
            return response(['message' => 'This User does not exist or Password is wrong!, check your details'], 400);
        }

        // $accessToken = Auth::user()->token();
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
  //      return redirect()->intended('home');
        
        return response()->json(['user' => auth()->user(), 'access_token' => $accessToken, 'iat' => date('Y-m-d H:i:s')]);
    }
    public function adminLogin(Request $request)
	{
		$request->validate([
            'email' => 'required|email',
    		'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
        
		if (Auth::attempt($credentials)) {
			
			$user = Auth::user();
			$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
			return response()->json(['success' => $success], 200);
		}
		else {
			return response()->json(['error' => 'Unauthorized'], 401);
		}
	}
	
	public function adminRegister(Request $request)
	{
		$request->validate([
            'name' => 'required',
			'email' => 'required|email',
			'password' => 'required',
			'c_password' => 'required|same:password',
        ]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);
		$success['name'] = $user->name;
		$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
		return response()->json(['success' => $success], 200);
	}
    public function logout(Request $request) {
        
        $accessToken = auth()->user()->token();
        $token= $request->user()->tokens->find($accessToken);
        $token->revoke();
         Auth::logout();

        return response(['message' => 'You have been successfully logged out.'], 200);
    }
    public function home()
    {
      return view('home');
    }
    public function reset_password(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $password = Hash::make($data['new_password']);
        $user->update([
            'password' => $password
        ]);
        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\User;
use Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success','Signed in!');
        }

        return redirect('/')->with('failed','Login detail are not valid!');
    }

    public function register_view() {
        return view('auth.register');
    } 

    public function register(Request $request) {

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        // dd($data);
        
        return redirect('/');
    }
    public function create(array $data) {

        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
    }


    public function dashboard(){
        if (Auth::check()){
            return view('dashboard');
        }
        // return redirect('/login');
    }

    public function signout(){
        Session::flush();
        Auth::logout();

    return redirect('/');
    }
}
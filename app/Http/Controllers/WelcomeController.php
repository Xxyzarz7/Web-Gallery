<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class WelcomeController extends Controller
{
    public function index(){
        return view('welcome', ['title' => 'Login - Web Media']);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::user()->role == 'user') {
                    return redirect()->route('home')->with('success', 'Berhasil Login');
                } else {
                    Auth::logout();     
                    return redirect()->route('welcome')->with('error', 'Anda tidak memiliki akses sebagai admin');
                }
            } else {
                return redirect()->route('welcome')->with('error', 'Email dan password salah');
            }
        } else {
            return redirect()->route('welcome')
                ->withInput()
                ->withErrors($validator);
        }
    }
    

    public function register(){
        return view('welcome');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->alamat = $request->alamat;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('welcome')->with('success', 'Berhasil register');
        } else {
            return redirect()->route('welcome')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('index')->with('success', 'Berhasil Logout');
    }
}

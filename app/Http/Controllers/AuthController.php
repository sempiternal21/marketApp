<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register() {
        return view('register');
    }

    public function registerPost(Request $request) {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $result = DB::table('users')->select('id')->where('email', $user->email)->first()->id;

        $token = $this->generateRandomString(127);
        $values = array('id' => $result,'token' => $token);
        DB::table('user_tokens')->insert($values);

        setcookie('user', $user->email);
        setcookie('token', $token);
        return redirect('/home')->with('success', 'Register OK');
    }

    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {
        $cred = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if(Auth::attempt($cred)) {
            $user_id = DB::table('users')->select('id')->where('email', $cred['email'])->first()->id;
            $result = DB::table('user_tokens')->select('token')->where('id', $user_id)->first()->token;

            setcookie('user', $cred['email']);
            return redirect('/home')->with('success', 'Login berhasil')->cookie('token', $result);
        }

        return back()->with('error', 'Email or Password error');
    }

    public function logout() {
        Auth::logout();
        setcookie('token', '', time() - 3600, '/');
        setcookie('user', '', time() - 3600, '/');

        return redirect()->route('login');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

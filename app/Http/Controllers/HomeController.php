<?php

namespace App\Http\Controllers;

use App\Models\AdModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $users = AdModel::orderBy('updated_at', 'desc')->paginate(3);
        foreach ($users as $item) {
            if ($item->author == $_COOKIE['user']) {
                $item->isSelf = true;
            }
        }
        return view('home', compact('users'));
    }

    public function create() {
        if(isset($_COOKIE['user'])) {
            return view('create');
        } else{
            return redirect('/login');
        }
    }

    public function createPost(Request $request) {
        $ad = new AdModel();
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->author = $_COOKIE['user'];
        $ad->price = $request->input('price');
        $ad->imageUrl = $request->input('imageUrl');
        $ad->save();

        return redirect('/home')->with('success', 'Login berhasil');
    }
}

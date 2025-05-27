<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //

    public function index(){
        $users = User::with('genre')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.movies.index',[ 'movies' => $movies]);        
    }
}

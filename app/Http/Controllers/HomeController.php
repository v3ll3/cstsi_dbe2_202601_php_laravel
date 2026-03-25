<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{

    public function index($name='Mundo!!!') {

        return view('olamundo',['name'=>$name]);
    }

    public function list() {

        $userList  = User::all();
       dd($userList);
       return View::make('user_list',compact('userList'));
    }
}

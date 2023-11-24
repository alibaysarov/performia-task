<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return Inertia::render('Home',[
            'title'=>'Todo List',
            'des'=>'lorem ipsum'
        ]);
        //return to_route('login');
    }
    public function login()
    {
        return Inertia::render('Login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\view;
class PagesController extends Controller
{
    public function index()
    {
        return view('/layouts/adminview/users');
    } 
}

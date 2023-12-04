<?php

namespace App\Http\Controllers;

use App\Models\Pouzivatel;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function login(){
        //php
        return view('login');
    }

    public function add(){
        // php
        return view('add');
    }
    public function documents(){
        return view('documents');
    }

    public function prace(){
        return view('prace');
    }

    public function pouzivatel_save(){
        $m = new Pouzivatel();

    }
}

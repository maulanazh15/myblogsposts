<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function show(){
        return view('welcome', [
            "title" => "Welcome",
            'active' => 'welcome'
        ]);
    }
}



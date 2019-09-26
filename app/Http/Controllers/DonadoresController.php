<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonadoresController extends Controller
{
    public function index(){
        return view('donadores',['activo'=>'donadores']);
    }
}

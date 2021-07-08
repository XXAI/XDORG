<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request){
        $entidades_federativas = \App\Models\EntidadFederativa::all();
        $seguros = \App\Models\Seguro::all();
        return view('registro-donadores',['estados'=>$entidades_federativas,'seguros'=>$seguros,'activo'=>'registro']);
    }
}

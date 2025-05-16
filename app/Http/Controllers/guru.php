<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class guru extends Controller
{
    public function tampilguru (){
        $guru = DB:: table('guru')->get();
        return view('profilguru', compact('guru'));
    }
}

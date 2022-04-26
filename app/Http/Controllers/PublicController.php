<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome(){
        $events=Event::orderBy('created_at' , 'desc')->get();
        return view("welcome" , compact("events"));
    }

    
}

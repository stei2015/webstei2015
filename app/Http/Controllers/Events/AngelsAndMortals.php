<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AngelsAndMortals extends Controller
{
    
	/**
     * Shows index page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('events.angelsandmortals');
    }

}

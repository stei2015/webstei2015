<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Event extends Controller
{
    
	/**
     * Handles event route
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    	// For now redirect to default event, later show event list and pictures

    	return redirect('events/angelsandmortals');
    }

}

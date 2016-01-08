<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    
	/**
     * Handles home route
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    	if (!Auth::user()->hp) {
    		return redirect('studentdata/'.Auth::user()->nim.'/edit');
    	}

    	if (!file_exists(storage_path('profilepictures/'.Auth::user()->nim))) {
    		return redirect('profilepictures/'.Auth::user()->nim.'/edit')->with('info', 'Isi foto profil terlebih dahulu sebelum melanjutkan');
    	}

        return redirect('studentdata');
    }


}

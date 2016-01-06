<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Lang;

class StudentData extends Controller
{
    
	/**
     * Shows a list of student data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    	$studentData = User::get();

    	return view('studentdata.index', ['studentData' => $studentData]);
    }



}

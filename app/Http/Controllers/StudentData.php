<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Gate;
use Auth;
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

        $privilege = Auth::user()->hasRole('studentdata-showprivate-all') ? 'private' : 'public';

    	$studentData = User::filter($privilege, $request['search'], $request['by'])->orderBy('nim')->get();

    	return view('studentdata.index', [
            'studentData' => $studentData,
            'studentDataColumns' => with(new User)->privilegeColumns[$privilege],
            'search' => $request['search'],
            'by' => $request['by'],
        ]);
    }

    /**
     * Shows individual student data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $privilege = Gate::allows('studentdata-showprivate', $request->nim) ? 'private' : 'public';

        $studentData = User::filter($privilege)->findOrFail($request->nim);

        return view('studentdata.show', [
            'studentData' => $studentData,
        ]);
    }



}

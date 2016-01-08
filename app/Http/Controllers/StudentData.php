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

        $nim = filter_var($request->nim, FILTER_SANITIZE_NUMBER_INT);

        $privilege = Gate::allows('studentdata-showprivate', $nim) ? 'private' : 'public';

        $studentData = User::filter($privilege)->findOrFail($nim);

        return view('studentdata.show', [
            'studentData' => $studentData,
        ]);
    }

    /**
     * Shows student data edit form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $nim = filter_var($request->nim, FILTER_SANITIZE_NUMBER_INT);

        if (Gate::denies('studentdata-edit', $nim)) {
            abort(403);
        }

        $studentData = User::findOrFail($nim);

        return view('studentdata.edit', [
            'studentData' => $studentData,
        ]);
    }

    /**
     * Updates student data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $nim = filter_var($request->nim, FILTER_SANITIZE_NUMBER_INT);

        if (Gate::denies('studentdata-edit', $nim)) {
            abort(403);
        }

        $this->validate($request, [
            'nama_lengkap'      => 'required',
            'nama_panggilan'    => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'sma'               => 'required',
            'alamat_asal'       => 'required',
            'kode_pos_asal'     => 'integer',
            'alamat_studi'      => 'required',
            'kode_pos_studi'    => 'integer',
            'hp'                => 'required',
            'telepon_darurat'   => 'required',
            'email'             => 'required|email',
            'email_students'    => 'required|email',
        ]);

        $studentData = User::findOrFail($nim);
        $studentData->fill($request->input());
        $studentData->save();

        return redirect('studentdata/'.$nim)->with('info', 'Data diri berhasil disimpan');
    }



}

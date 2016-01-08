<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilePicture extends Controller
{
    
	/**
     * Shows profile picture
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    	$nim = filter_var($request->nim, FILTER_SANITIZE_NUMBER_INT);

    	$filePath = storage_path('profilepictures/'.$nim);
    	if (!file_exists($filePath)) {
    		$filePath = public_path('img/defaultprofilepicture');
    	}

    	return response(file_get_contents($filePath))
    		->header('Content-Type', exif_imagetype($filePath))
    		->header('Content-Length', filesize($filePath));
    }

    /**
     * Shows profile picture edit form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    	$nim = filter_var($request->nim, FILTER_SANITIZE_NUMBER_INT);
    	$filePath = storage_path('profilepictures/'.$nim);

        if (Gate::denies('studentdata-edit', $request->nim)) {
            abort(403);
        }

        return view('profilepictures.edit', ['nim' => $nim, 'hasPicture' => file_exists($filePath)]);
    }

    /**
     * Updates profile picture
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
            'profilepicture' => 'required|image|max:256',
        ]);

        $request->file('profilepicture')->move(storage_path('profilepictures'), $nim);

        return redirect('studentdata/'.$nim)->with('info', 'Foto berhasil disimpan');
    }

}

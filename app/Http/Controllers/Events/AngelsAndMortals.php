<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event_AngelsAndMortals.php;
use App\Message.php;
use App\User.php;

class AngelsAndMortals extends Controller
{

    /**
     * Gets angel, mortal, and guess data for the specified NIM.
     * If the NIM is not specified, it uses the currently logged in user.
     * Returns null if the NIM is not listed in the angels and mortals table.
     *
     * @param  integer  $nim
     * @return array
     */
    private function getAngelsAndMortalsData($nim = null) {
        if ($nim === null) $nim = Auth::user()->nim;

        $data = Event_AngelsAndMortals::find($nim);
        if ($data === null) return null;

        $angel = Event_AngelsAndMortals::where('mortal', '=', $nim)->value('nim');

        return [
            'angel'  => $angel,
            'mortal' => $data->mortal,
            'guess'  => $data->guess,
        ];
    }

    
	/**
     * Shows index page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nim = Auth::user()->nim;
        $data = getAngelsAndMortalsData($nim);

        if ($data === null) {
            return view('events.angelsandmortals', [
                'isPlayer' => false,
            ]);
        }

        $mortalMessages = Messages::where('type', '=', 'angelsandmortals')
            ->where(function ($query) {
                $query->where(function ($queryA) {
                    $queryA->where('from', '=', $nim)->where('to', '=', $data['mortal']);
                })->orWhere(function ($queryB) {
                    $queryB->where('to', '=', $nim)->where('from', '=', $data['mortal']);
                });
            })
            ->orderBy('created_at', 'asc');

        $angelMessages = Messages::where('type', '=', 'angelsandmortals')
            ->where(function ($query) {
                $query->where(function ($queryA) {
                    $queryA->where('from', '=', $nim)->where('to', '=', $data['angel']);
                })->orWhere(function ($queryB) {
                    $queryB->where('to', '=', $nim)->where('from', '=', $data['angel']);
                });
            })
            ->orderBy('created_at', 'asc');

        $mortal = User::find($data['mortal']);
        $guess = User::find($data['guess']);

        return view('events.angelsandmortals', [
            'isPlayer' => true,
            'mortal' => $data['mortal'],
            'mortalName' => $mortal !== null ? $mortal->nama_lengkap : '',
            'guess' => $data['guess'],
            'guessName' => $guess !== null ? $guess->nama_lengkap : '',
            'mortalMessages' => $mortalMessages,
            'angelMessages' => $angelMessages,
        ]);
    }

    /**
     * Processes a mortal guess
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guess(Request $request)
    {
        $nim = Auth::user()->nim;
        $data = getAngelsAndMortalsData($nim);

        if ($data === null) {
            abort(403);
        }

        $this->validate($request, [
            $nim => 'required|numeric|min:16515001|max:16515500',
        ]);

        Event_AngelsAndMortals::where('nim', '=', $nim)->update(['guess' => $request['nim']])

        return redirect('events/angelsandmortals')->with('info', 'Tebakan berhasil disimpan');
    }

    /**
     * Sends a message to the current user's mortal
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function messageMortal(Request $request)
    {
        $nim = Auth::user()->nim;
        $data = getAngelsAndMortalsData($nim);

        if ($data === null) {
            abort(403);
        }

        $message = new Message;
        $message->from = $nim;
        $message->to = $data['mortal'];
        $message->content = $request['message'];
        $message->type = 'angelsandmortals';
        $message->save();

        return redirect('events/angelsandmortals')->with('info', 'Pesan berhasil dikirim ke mortal');
    }

    /**
     * Sends a message to the current user's angel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function messageAngel(Request $request)
    {
        $nim = Auth::user()->nim;
        $data = getAngelsAndMortalsData($nim);

        if ($data === null) {
            abort(403);
        }

        $message = new Message;
        $message->from = $nim;
        $message->to = $data['angel'];
        $message->content = $request['message'];
        $message->type = 'angelsandmortals';
        $message->save();

        return redirect('events/angelsandmortals')->with('info', 'Pesan berhasil dikirim ke angel');
    }

}

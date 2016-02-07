<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;

use Auth;
use \DateTime;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event_AngelsAndMortals;
use App\Message;
use App\User;

class AngelsAndMortals extends Controller
{

    /**
     *
     * ANM round deploy instructions:
     * 1. Backup database
     * 2. Clear previous ANM data and messages from DB
     * 3. Set dates, results link, round
     * 4. Deploy to Openshift
     * 5. Before game starts, randomize mortal list
     *
     */

    // TODO: add admin page, view all messages page, view ANM data page, admin guards

    protected $gameInfo;

    function __construct() {
        //parent::__construct(); // The Controller class apparently has no existing constructor

        $this->gameInfo = [
            'round' => 1,
            'registrationStartDate' => new DateTime("2016-01-01 00:00:00"),
            'registrationEndDate' => new DateTime("2016-01-17 12:00:00"),
            'gameStartDate' => new DateTime("2016-01-18 12:00:00"),
            'gameEndDate' => new DateTime("2016-02-07 23:59:59"),
            'completeResultsLink' => null, // e.g. 'anm-round1-results.pdf'
        ];
    }

    /**
     * Gets angel, mortal, and guess data for the specified NIM.
     * If the NIM is not specified, it uses the currently logged in user.
     * Returns null if the NIM is not listed in the angels and mortals table.
     *
     * @param  integer  $nim
     * @return array
     */
    protected function getAngelsAndMortalsData($nim = null)
    {
        if ($nim === null) $nim = Auth::user()->nim;

        $data = Event_AngelsAndMortals::find($nim);
        if ($data === null) return null;

        $angel = Event_AngelsAndMortals::where('mortal', '=', $nim)->value('nim');

        if ($data->guess === 0) $data->guess = null;

        return [
            'angel'  => $angel,
            'mortal' => $data->mortal,
            'guess'  => $data->guess,
        ];
    }


    /**
     * Processes a registration request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $nim = Auth::user()->nim;
        $now = new DateTime("now");

        if ($now < $this->gameInfo['registrationStartDate']) {
            return redirect('events/angelsandmortals')->with('warning', 'Registrasi gagal - periode registrasi belum dimulai');
        }

        if ($now > $this->gameInfo['registrationEndDate']) {
            return redirect('events/angelsandmortals')->with('warning', 'Registrasi gagal - periode registrasi telah berakhir');
        }

        $data = Event_AngelsAndMortals::find($nim);
        if ($data !== null) {
            return redirect('events/angelsandmortals')->with('warning', 'Kamu sudah terdaftar');
        }
        
        $newParticipant = new Event_AngelsAndMortals;
        $newParticipant->nim = $nim;
        $newParticipant->save();

        return redirect('events/angelsandmortals')->with('info', 'Registrasi berhasil');
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
        $data = $this->getAngelsAndMortalsData($nim);
        $now = new DateTime("now");
        $isPlayer = $data !== null;    

        // If the game has ended, show the game results view

        if ($now > $this->gameInfo['gameEndDate']) {

            if ($isPlayer) {

                $angel = User::find($data['angel']);
                $guess = User::find($data['guess']);

                return view('events.angelsandmortals.result', [
                    'isPlayer' => $isPlayer,
                    'guess' => $data['guess'],
                    'guessName' => $guess !== null ? $guess->nama_lengkap : $data['guess'],
                    'angel' => $data['angel'],
                    'angelName' => $angel !== null ? $angel->nama_lengkap : $data['angel'],
                    'gameInfo' => $this->gameInfo,
                ]);
            }

            return view('events.angelsandmortals.result', [
                'isPlayer' => $isPlayer,
                'gameInfo' => $this->gameInfo,
            ]);
        }

        // Before the game starts or if the game is running and you are not a participant, show registration view

        if ($now < $this->gameInfo['gameStartDate'] || !$isPlayer) {
            return view('events.angelsandmortals.register', [
                'isPlayer' => $isPlayer,
                'gameInfo' => $this->gameInfo,
            ]);
        }

        // If the game is in progress and the current user is participating, show game view

        $mortalMessages = Message::where('type', '=', 'angelsandmortals')
            ->where(function ($query) use ($nim, $data) {
                $query->where(function ($queryA) use ($nim, $data) {
                    $queryA->where('from', '=', $nim)->where('to', '=', $data['mortal']);
                })->orWhere(function ($queryB) use ($nim, $data) {
                    $queryB->where('to', '=', $nim)->where('from', '=', $data['mortal']);
                });
            })
            ->orderBy('created_at', 'asc')->get();

        $angelMessages = Message::where('type', '=', 'angelsandmortals')
            ->where(function ($query) use ($nim, $data) {
                $query->where(function ($queryA) use ($nim, $data) {
                    $queryA->where('from', '=', $nim)->where('to', '=', $data['angel']);
                })->orWhere(function ($queryB) use ($nim, $data) {
                    $queryB->where('to', '=', $nim)->where('from', '=', $data['angel']);
                });
            })
            ->orderBy('created_at', 'asc')->get();

        $mortal = User::find($data['mortal']);
        $guess = User::find($data['guess']);

        return view('events.angelsandmortals.game', [
            'mortal' => $data['mortal'],
            'mortalName' => $mortal !== null ? $mortal->nama_lengkap : '[ Nama tidak ada di data ]',
            'guess' => $data['guess'],
            'guessName' => $guess !== null ? $guess->nama_lengkap : $data['guess'],
            'mortalMessages' => $mortalMessages,
            'angelMessages' => $angelMessages,
            'gameInfo' => $this->gameInfo,
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
        $data = $this->getAngelsAndMortalsData($nim);
        $now = new DateTime("now");

        if ($data === null || ($now < $this->gameInfo['gameStartDate']) || ($now > $this->gameInfo['gameEndDate'])) {
            abort(403);
        }

        $this->validate($request, [
            'nim' => 'required|numeric|min:16515001|max:16515500',
        ]);

        Event_AngelsAndMortals::where('nim', '=', $nim)->update(['guess' => $request['nim']]);

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
        $data = $this->getAngelsAndMortalsData($nim);
        $now = new DateTime("now");

        if ($data === null || ($now < $this->gameInfo['gameStartDate']) || ($now > $this->gameInfo['gameEndDate'])) {
            abort(403);
        }

        $this->validate($request, [
            'message' => 'required',
        ]);

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
        $data = $this->getAngelsAndMortalsData($nim);
        $now = new DateTime("now");

        if ($data === null || ($now < $this->gameInfo['gameStartDate']) || ($now > $this->gameInfo['gameEndDate'])) {
            abort(403);
        }

        if ($data['angel'] === null) {
            return redirect('events/angelsandmortals')->with('warning', 'Tidak dapat mengirim pesan; kamu ternyata tidak memiliki angel :(');
        }

        $this->validate($request, [
            'message' => 'required',
        ]);

        $message = new Message;
        $message->from = $nim;
        $message->to = $data['angel'];
        $message->content = $request['message'];
        $message->type = 'angelsandmortals';
        $message->save();

        return redirect('events/angelsandmortals')->with('info', 'Pesan berhasil dikirim ke angel');
    }

}

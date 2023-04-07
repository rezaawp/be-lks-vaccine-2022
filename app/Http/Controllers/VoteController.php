<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    function store(Request $request)
    {
        $userId = (int)Auth::user()->id;
        $find_vote = Vote::where('user_id', $userId)->where('polling_id', $pollingid)->first();
        if ($find_vote) return redirect()->back()->with('voteunique', 'Kamu tidak bisa vote 2x');
        if (!$request['choises']) {
            return redirect()->back()->withErrors([
                'choisesRequired' => 'Choises wajib di isi'
            ]);
        }

        $choiseId = (int)$request['choises'];
        $pollingid = (int)$request['pollingId'];

        // Validasi bahwa vote adalah unique

        $voteCreated = Vote::create([
            'user_id' => $userId,
            'polling_id' => $pollingid,
            'choise_id' => $choiseId
        ]);

        if ($voteCreated) {
            return redirect()->back()->with('voted', 'Vote kamu berhasil di kirim');
        } else {
            return redirect()->back()->withErrors('voteError', 'Vote kamu tidak berhasil dikirim, silahkan coba lagi nanti');
        }
    }
}

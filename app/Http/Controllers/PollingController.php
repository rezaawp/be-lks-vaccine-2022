<?php

namespace App\Http\Controllers;

use App\Models\Choise;
use App\Models\Polling;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollingController extends Controller
{
    //
    function index()
    {
        $pollings = Polling::all();
        $data['pollings'] = $pollings;
        return view('home', $data);
    }

    function create()
    {
        return view('createpoll');
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'choises.*' => ['required'],
            'deadline' => ['required']
        ]);

        $title = $request['title'];
        $choises = $request['choises'];
        $deadline = strtotime($request['deadline']);

        $pollingStore = Polling::create([
            'title' => $title,
            'user_id' => Auth::user()->id,
            'deadline' => $deadline
        ]);

        foreach ($choises as $choise) {
            Choise::create([
                'choise' => $choise,
                'polling_id' => $pollingStore['id']
            ]);
        }

        return redirect()->back()->with('pollingCreated', 'Polling sudah berhasil dibuat');
    }

    function show(Request $request, $pollingId)
    {
        $data['pollingId'] = $pollingId;
        $userId = Auth::user()->id;

        $data['voted'] = Vote::where('user_id', $userId)->where('polling_id', $pollingId)->first() ? true : false;

        // return  2 / 2 * 100;

        $data['polling'] = Polling::where('id', $pollingId)->with(['choises.votes' => function (Builder $q) use ($pollingId) {
            return $q->where('polling_id', $pollingId);
        }, 'user', 'votes' => function (Builder $q) use ($pollingId) {
            return $q->where('polling_id', $pollingId);
        }])->withCount(['votes' => function (Builder $q) use ($pollingId) {
            return $q->where('polling_id', $pollingId);
        }])->get()->map(function ($poll) {
            $count_votes = count($poll->votes);
            $persentase_choises = collect($poll['choises'])->map(function ($choise, $index) use ($count_votes) {
                $count_voted = count($choise['votes']);
                // $choise['count_votes'] = $count_votes;
                $choise['persentase_vote'] = $count_voted <= 0 ? 0 :  $count_voted / $count_votes * 100;
                unset($choise['votes']);
                return $choise;
            });
            unset($poll['votes']);
            return $poll;
        })->first();


        !$data['polling'] && abort(404);
        $data['created_at'] = Carbon::parse($data['polling']['created_at'])->diffInMinutes() < 24 * 60 ? Carbon::parse($data['polling']['created_at'])->diffInMinutes() . ' menit yang lalu' : Carbon::parse($data['polling']['created_at'])->diffInDays() . ' hari yang lalu';

        return view('polling', $data);
    }
}

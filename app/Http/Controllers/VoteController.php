<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Kandidate;
use Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        if (Auth::user()->has_voted) {
            return redirect('/dashboard')->with('info', 'Anda sudah memilih.');
        }

        $kandidats = DB::table('candidates')->get();
        return view('vote.index', compact('kandidats'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->has_voted) {
            return redirect('/dashboard')->with('info', 'Anda sudah memilih.');
        }

        $user->has_voted = true;
        $user->kandidat_id = $request->input('kandidat_id');
        $user->save();

        return redirect('/home')->with('success', 'Terima kasih! Suara Anda telah tercatat.');
    }

    public function report()
    {

        $jumlahWarga = DB::table('users')->where('role','warga')->count();
        $jumlahSudahMemilih = DB::table('users')->where('role','warga')->where('has_voted',true)->count();
        $jumlahBelumMemilih = $jumlahWarga - $jumlahSudahMemilih;
        $kandidates = DB::table('candidates')->get();
        $totalVotes = 0;

        foreach ($kandidates as $kandidate) {
            $kandidate->votes_count = \App\User::where('kandidat_id', $kandidate->id)->count();
            $totalVotes += $kandidate->votes_count;
        }

        $winner = $kandidates->sortByDesc('votes_count')->first();

        return view('vote.report', [
            'kandidates' => $kandidates,
            'totalVotes' => $totalVotes,
            'winner_id' => $winner ? $winner->id : null,
            'jumlahWarga' => $jumlahWarga,
            'jumlahSudahMemilih' => $jumlahSudahMemilih,
            'jumlahBelumMemilih' => $jumlahBelumMemilih
        ]);
    }

}

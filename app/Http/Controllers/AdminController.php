<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Candidate;
use App\Models\Kandidate;

class AdminController extends Controller
{
    public function index() {
        $data = DB::table('users')->where('role','warga')->paginate(20);
        $warga = DB::table('users')->where('role','warga')->get();
        $totalWarga = $warga->count();
        $sudahMemilih = $warga->where('has_voted', 1)->count();
        $belumMemilih = $warga->where('has_voted', 0)->count();

        $kandidats = DB::table('candidates')->get();

        return view('home_admin', compact('data','warga', 'totalWarga', 'sudahMemilih', 'belumMemilih', 'kandidats'));
    }

    public function store(Request $request) {
        Candidate::create($request->all());
        return back()->with('success', 'Kandidat ditambahkan!');
    }

    
}

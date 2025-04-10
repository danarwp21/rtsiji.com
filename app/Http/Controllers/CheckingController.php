<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Kandidate;
use Auth;
use Illuminate\Support\Facades\DB;

class CheckingController extends Controller
{

    public function getNamaByNik(Request $request)
    {
        $request->validate(['nik' => 'required']);
        
        $user = DB::table('users')->where('nik', $request->nik)->first();

        if (!$user) {
            return response()->json(['error' => 'NIK tidak ditemukan'], 404);
        }

        return response()->json(['nama' => $user->name]);
    }

}

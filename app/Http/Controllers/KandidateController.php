<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KandidateController extends Controller
{
    public function create()
    {
        return view('kandidat.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'foto' => 'required|image|max:2048',
        ]);
    
        $fotoPath = $request->file('foto')->store('kandidat', 'public');
    
        DB::table('candidates')->insert([
            'nama' => $request->nama,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'foto' => $fotoPath,
        ]);
    
        return redirect()->route('admin')->with('success', 'Kandidat berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $kandidat = DB::table('candidates')->where('id',$id)->delete();

        return redirect()->back()->with('success', 'Kandidat berhasil dihapus.');
    }

    
}

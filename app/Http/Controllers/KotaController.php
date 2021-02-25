<?php

namespace App\Http\Controllers;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Http\Controllers\DB;

use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kota = Kota::with('provinsi')->get();
        return view('layouts.kota.index',compact('kota'));
    }

    public function create()
    {
        $provinsi = Provinsi::all();
        return view('layouts.kota.create',compact('provinsi'));
    }

    public function store(Request $request)
    {

       //validasi
     $request->validate(
        [
        'kode_kota' => 'required|max:5|unique:kotas',
        'nama_kota' => 'required|unique:kotas',
        ],
        [
        'kode_kota.required' => 'kode harus Di Isi',
        'kode_kota.max' => 'kode Maksimal 4 Nomor',
        'kode_kota.unique' => 'kode Sudah Dipakai',
        'nama_kota.require' => 'Nama kota Harus Di Isi ',
        'nama_kota.unique' => 'Kode Sudah Dipakai',
        ]);
    
        $kota = new kota;
        $kota->id_provinsi   = $request->id_provinsi;
        $kota->kode_kota     = $request->kode_kota;
        $kota->nama_kota     = $request->nama_kota;
        $kota->save();
        return redirect()->route('kota.index');
    }

    public function show($id)
    {   
        $kota = Kota::findOrFail($id);
        return view('layouts.kota.show', compact('kota'));
    }
   
    public function edit($id)
    {
        $provinsi = Provinsi::all();
        $kota = Kota::findOrFail($id);
        return view('layouts.kota.edit', compact('kota','provinsi'));
    }

    public function update(Request $request, $id)
    {
        $kota = Kota::findOrFail($id);
        $kota->id_provinsi    = $request->id_provinsi;
        $kota->kode_kota      = $request->kode_kota;
        $kota->nama_kota      = $request->nama_kota;
        $kota->save();
        return redirect()->route('kota.index');
    }

    public function destroy($id)
    {
        $kota = Kota::findOrFail($id)->delete();
        return redirect()->route ('kota.index')
                         ->with  (['message' => 'Data Negara Berhasil Dihapus']);
    }
}

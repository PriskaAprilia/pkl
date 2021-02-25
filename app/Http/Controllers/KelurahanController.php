<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Http\Controllers\DB;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelurahan = Kelurahan::with('kecamatan')->get();
        return view('layouts.kelurahan.index',compact('kelurahan'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('layouts.kelurahan.create',compact('kecamatan'));
    }

    public function store(Request $request)
    {
//validasi
$request->validate(
    [
    'nama_kelurahan' => 'required|unique:kelurahans',
    ],
    [
    'nama_kelurahan.require' => 'Nama kelurahan Harus Di Isi ',
    'nama_kelurahan.unique' => 'Kode Sudah Dipakai',
    ]);

        $kelurahan= new Kelurahan();
        $kelurahan->nama_kelurahan  = $request->nama_kelurahan;
        $kelurahan->id_kecamatan    = $request->id_kecamatan;
        $kelurahan->save();
        return redirect()->route('kelurahan.index')
                         ->with (['message'=>'Data Berhasil Dibuat']);
    }

    public function show($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        return view('layouts.kelurahan.show',compact('kelurahan'));
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::findOrFail($id);
        return view('Layouts.kelurahan.edit',compact('kelurahan','kecamatan'));
    }

    public function update(Request $request, $id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->nama_kelurahan  = $request->nama_kelurahan;
        $kelurahan->id_kecamatan    = $request->id_kecamatan;
        $kelurahan->save();
        return redirect()->route('kelurahan.index')
                         ->with (['message'=>'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $kelurahan = Kelurahan::findOrFail($id)->delete();
        return redirect()->route('kelurahan.index')
                         ->with (['message1'=>'Data Berhasil Dihapus']);
    }
}
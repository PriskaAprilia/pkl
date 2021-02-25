<?php

namespace App\Http\Controllers;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Http\Controllers\DB;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kecamatan = Kecamatan::all();
        return view('layouts.kecamatan.index',compact('kecamatan'));
    }

    public function create()
    {
        $kota = Kota::all();
        return view('layouts.kecamatan.create',compact('kota'));
    }

    public function store(Request $request)
    {
 //validasi
 $request->validate(
    [
    'kode_kecamatan' => 'required|max:8|unique:kecamatans',
    'nama_kecamatan' => 'required|unique:kecamatans',
    ],[
    'kode_kecamatan.requiredcg' => 'kode harus Di Isi',
    'kode_kecamatan.max' => 'kode Maksimal 4 Nomor',
    'kode_kecamatan.unique' => 'kode Sudah Dipakai',
    'nama_kecamatan.require' => 'Nama kecamatan Harus Di Isi ',
    'nama_kecamatan.unique' => 'Kode Sudah Dipakai',
    ]);

        $kecamatan = new kecamatan;
        $kecamatan->id_kota         = $request->id_kota;
        $kecamatan->kode_kecamatan  = $request->kode_kecamatan;
        $kecamatan->nama_kecamatan  = $request->nama_kecamatan;
        $kecamatan->save();
        return redirect()->route('kecamatan.index');
    }

    public function show($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        return view('layouts.kecamatan.show', compact('kecamatan'));
    }

    public function edit($id)
    {
        $kota = Kota::all();
        $kecamatan = Kecamatan::findOrFail($id);
        return view('layouts.kecamatan.edit', compact('kecamatan','kota'));
    }

    public function update(Request $request, $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->id_kota          = $request->id_kota;
        $kecamatan->kode_kecamatan   = $request->kode_kecamatan;
        $kecamatan->nama_kecamatan   = $request->nama_kecamatan;
        $kecamatan->save();
        return redirect()->route('kecamatan.index');
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id)->delete();
        return redirect()->route ('kecamatan.index')
                         ->with  (['message' => 'Data Negara Berhasil Dihapus']);
    }
}

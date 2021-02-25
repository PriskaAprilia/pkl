<?php

namespace App\Http\Controllers;
use App\Models\Provinsi;
use App\Http\Controllers\DB;

use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       
        $provinsi = Provinsi::all();
        return view('layouts.provinsi.index',compact('provinsi'));
        
    }

    public function create()
    {
        return view('layouts.provinsi.create');
    }

    public function store(Request $request)
    {
        $provinsi = new Provinsi;
        $provinsi->kode_provinsi   = $request->kd_prov;
        $provinsi->nama_provinsi   = $request->nm_prov;
        $provinsi->save();
        return redirect()->route('provinsi.index');

    }

    public function show($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('layouts.provinsi.show', compact('provinsi'));
    }

    public function edit($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('layouts.provinsi.edit', compact('provinsi'));
    }

    public function update(Request $request, $id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->id               = $request->id;
        $provinsi->nama_provinsi    = $request->nama_provinsi;
        $provinsi->save();
        return redirect()->route('provinsi.index');
    }

    public function destroy($id)
    {
        $provinsi=Provinsi::findOrFail($id)->delete();
        return redirect()->route ('provinsi.index')
                         ->with  (['message'=>'Data Berhasil Di Hapus']);
    }
}

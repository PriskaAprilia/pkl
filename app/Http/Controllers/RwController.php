<?php

namespace App\Http\Controllers;
use App\Models\Kelurahan;
use App\Models\Rw;
use App\Http\Controllers\DB;
use Illuminate\Http\Request;

class RwController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rw = Rw::with('kelurahan')->get();
        return view('layouts.rw.index',compact('rw'));
    }

    public function create()
    {
        $kelurahan = Kelurahan::all();
        return view('layouts.rw.create',compact('kelurahan'));
    }

    public function store(Request $request)
    {
    
    $request->validate( 
    [
        'nama_rw' => 'required|unique:rws',
    ],
    [
        'nama_rw.require' => 'Nama Rw Harus Di Isi ',
        'nama_rw.unique' => 'Kode Sudah Dipakai',
    ]);

        $rw= new Rw();
        $rw->nama_rw       = $request->nama_rw;
        $rw->id_kelurahan  = $request->id_kelurahan;
        $rw->save();
        return redirect()->route('rw.index')
                         ->with (['message'=>'Data Berhasil Dibuat']);
    }

    public function show($id)
    {
        $rw = Rw::findOrFail($id);
        return view('layouts.rw.show',compact('rw'));
    }

    public function edit($id)
    {
        $kelurahan = Kelurahan::all();
        $rw = Rw::findOrFail($id);
        return view('Layouts.rw.edit',compact('rw','kelurahan'));
    }

    public function update(Request $request, $id)
    {
        $rw = Rw::findOrFail($id);
        $rw->nama_rw       = $request->nama_rw;
        $rw->id_kelurahan  = $request->id_kelurahan;
        $rw->save();
        return redirect()->route('rw.index')
                         ->with (['message'=>'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $rw = Rw::findOrFail($id)->delete();
        return redirect()->route('rw.index')
                         ->with (['message1'=>'Data Berhasil Dihapus']);
    }
}

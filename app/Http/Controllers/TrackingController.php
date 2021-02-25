<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Rw;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $tracking = Tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
        return view('layouts.tracking.index',compact('tracking'));
    }

    public function create()
    {
        $rw = Rw::all();
        return view('layouts.tracking.create',compact('rw'));
    }

    public function store(Request $request)
    {
        $tracking = new Tracking;
        $tracking->id_rw      = $request->id_rw;
        $tracking->positif    = $request->positif;
        $tracking->sembuh     = $request->sembuh;
        $tracking->meninggal  = $request->meninggal;
        $tracking->save();
        return redirect()->route('tracking.index')
                         ->with(['message'=>'Data Berhasil Dibuat']);
    }

    public function show($id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('layouts.tracking.show',compact('tracking'));
    }

    public function edit( $id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('layouts.tracking.edit',compact('tracking'));
    }

    public function update(Request $request,  $id)
    {
        $tracking = Tracking::findOrFail($id);
        $tracking->id_rw      = $request->id_rw;
        $tracking->positif    = $request->positif;
        $tracking->sembuh     = $request->sembuh;
        $tracking->meninggal  = $request->meninggal;
        $tracking->save();
        return redirect()->route('tracking.index')
                         ->with (['message'=>'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $tracking = Tracking::findOrFail($id)->delete();
        return redirect()->route('tracking.index')
                         ->with (['message1'=>'Data Berhasil Dihapus']);
    }
}
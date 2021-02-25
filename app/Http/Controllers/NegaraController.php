<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;

class NegaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $negara = Negara::all();
            return view('layouts.negara.index',compact('negara'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.negara.create');
    }

    public function store(Request $request)
    {
        $negara = new Negara;
        $negara->id = $request->id;
        $negara->nama_negara = $request->nama_negara;
        $negara->save();
        return redirect()->route('negara.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Negara  $negara
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $negara = Negara::findOrFail($id);
        return view('layouts.negara.show', compact('negara'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Negara  $negara
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $negara = Negara::findOrFail($id);
        return view('layouts.negara.edit', compact('negara'));
    }

    public function update(Request $request, $id)
    {
        $negara = Negara::findOrFail($id);
        $negara->id = $request->id;
        $negara->nama_negara= $request->nama_prov;
        $negara->save();
        return redirect()->route('negara.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Negara  $negara
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $negara = Negara::findOrFail($id)->delete();
        return redirect()->route('negara.index')->with(['message' => 'Data Negara Berhasil Dihapus']);
    }
}
@extends('layouts/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Kota') }}</div>
                <div class="card-body">

                <form action="{{route('kecamatan.index',$kecamatan->id)}}" method="GET">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Kota</label>
                        <input type="text" name="kode_kecamatan" value="{{$kecamatan->kode_kecamatan}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kota</label>
                        <input type="text" name="nama_kecamatan" value="{{$kecamatan->nama_kecamatan}}" class="form-control" id="exampleInputPassword1">
                    </div>  

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">nama kecamatan</label>
                        <input type="text" name="nama_kecamatan" value="{{$kecamatan->nama_kecamatan}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>                            
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

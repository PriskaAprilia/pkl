@extends('layouts/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show provinsi') }}</div>
                <div class="card-body">

                <form action="{{route('kota.index',$kota->id)}}" method="GET">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Provinsi</label>
                        <input type="text" name="nama_provinsi" value="{{$kota->provinsi->nama_provinsi}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kode Kota</label>
                        <input type="text" name="kode_kota" value="{{$kota->kode_kota}}" class="form-control" id="exampleInputPassword1">
                    </div>   

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kota</label>
                        <input type="text" name="nama_kota" value="{{$kota->nama_kota}}" class="form-control" id="exampleInputPassword1">
                    </div>               
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

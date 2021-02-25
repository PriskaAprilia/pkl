@extends('layouts/master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Negara') }}</div>
                <div class="card-body">

                <form action="{{route('kota.update',$kota->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="">Provinsi</label>
                        <select name="id_provinsi" class="form-control" required>
                            @foreach($provinsi as $data)
                            <option value="{{$data->id}}"
                                {{$data->id == $kota->id_provinsi ? "selected":""}}>{{$data->nama_provinsi}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Kode</label>
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
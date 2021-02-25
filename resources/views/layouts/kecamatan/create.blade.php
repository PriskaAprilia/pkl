@extends('layouts/master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data kecamatan') }}</div>
                <div class="card-body">

                <form action="{{route('kecamatan.store')}}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode kecamatan</label>
                    <input type="text" name="kode_kecamatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @if($errors->has('kode_kecamatan'))
                           <span class="text-danger">{{ $errors->first('kode_kecamatan')}}</span>
                        @endif
                </div>
  
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">kecamatan</label>
                    <input type="text" name="nama_kecamatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @if($errors->has('nama_kecamatan'))
                           <span class="text-danger">{{ $errors->first('nama_kecamatan')}}</span>
                        @endif
                </div>

                <div class="form-group">
                        <label for="">Provinsi</label>
                        <select name="id_kota" class="form-control" required>
                            @foreach($kota as $data)
                                <option value="{{$data->id}}">{{$data->nama_kota}}</option>
                            @endforeach
                        </select>
                    </div>
               <button type="submit" class="btn btn-primary">Submit</button>

                </form>                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
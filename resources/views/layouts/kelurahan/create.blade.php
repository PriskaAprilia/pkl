@extends('layouts/master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Kelurahan') }}</div>
                <div class="card-body">

              <form action="{{route('kelurahan.store')}}" method="POST">
                @csrf

                <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select name="id_kecamatan" class="form-control" required>
                            @foreach($kecamatan as $data)
                                <option value="{{$data->id}}">{{$data->nama_kecamatan}}</option>
                            @endforeach
                        </select>
                    </div>
  
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama kelurahan</label>
                <input type="text" name="nama_kelurahan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @if($errors->has('nama_kelurahan'))
                           <span class="text-danger">{{ $errors->first('nama_kelurahan')}}</span>
                        @endif
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>

              </form>                       
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts/master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Rw') }}</div>
                <div class="card-body">

              <form action="{{route('rw.store')}}" method="POST">
                @csrf

                <div class="form-group">
                        <label for="">Kelurahan</label>
                        <select name="id_kelurahan" class="form-control" required>
                            @foreach($kelurahan as $data)
                                <option value="{{$data->id}}">{{$data->nama_kelurahan}}</option>
                            @endforeach
                        </select>
                    </div>
  
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Rw</label>
                <input type="text" name="nama_rw" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @if($errors->has('nama_rw'))
                           <span class="text-danger">{{ $errors->first('nama_rw')}}</span>
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
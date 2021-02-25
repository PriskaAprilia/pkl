@extends('layouts/master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data provinsi') }}</div>
                <div class="card-body">

              <form action="{{route('provinsi.store')}}" method="POST">
                @csrf

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kode Provinsi</label>
                <input type="text" name="kd_prov" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
  
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Provinsi</label>
                <input type="text" name="nm_prov" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>

              </form>                       
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
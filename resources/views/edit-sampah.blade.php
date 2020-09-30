@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Data Setor Sampah</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('sampah') }}">Sampah</a></li>
          <li class="breadcrumb-item active">Edit Data Setor Sampah</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card card-success">
          <div class="card-body">
             <form action="{{ route('setor-update') }}" role="form" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="id" id="id" value="{{ $setor->id}}">
                  <label>Jenis Sampah</label>
                  <select name="jenis" class="form-control">
                    <option value="">Pilih Jenis Sampah</option>
                    @foreach($jenis as $data)
                      @if($data->id == $setor->jenis)
                      <option value="{{ $data->id }}" selected>{{ $data->jenis }}</option>
                      @else
                      <option value="{{ $data->id }}">{{ $data->jenis }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kiloan">Kiloan</label>
                  <input name="kiloan" type="text" class="form-control" id="kiloan" value="{{ $setor->kiloan }}">
                </div>
                <div class="form-group">
                  <label for="pendapatan">Pendapatan</label>
                  <input name="pendapatan" type="number" class="form-control" value="{{ $setor->pendapatan }}">
                </div>
                <div class="form-group">
                  <label>Penyetor</label>
                  <select name="penyetor" class="form-control">
                    <option value="">Pilih</option>
                    @auth
                    @if(Auth::user()->role_id == "1")
                    @foreach($users as $users)
                      @if($users->id == $setor->penyetor)
                    <option value="{{ $users->id }}" selected>{{ $users->name }}</option>
                      @else
                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                      @endif
                    @endforeach
                    @else
                    @foreach($userrole as $userrole)
                      @if($userrole->id == $setor->penyetor)
                    <option value="{{ $userrole->id }}" selected>{{ $userrole->name }}</option>
                      @else
                    <option value="{{ $userrole->id }}">{{ $userrole->name }}</option>
                      @endif
                    @endforeach
                    @endif
                    @endauth
                  </select>
                </div>
                <input name="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
                <input type="hidden" name="tanggal_setor" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@endsection

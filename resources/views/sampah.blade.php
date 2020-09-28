@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Seluruh Sampah User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Sampah</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <div class="col-6">
                    @if (session('status'))
                    <div class="alert alert-info alert-disabled fade show bg-icon" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                  Tambah Sampah
                </button>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover"> 
              <thead>
              <tr>
                <th>Jenis Sampah</th>
                <th>Kiloan</th>
                <th>Pendapatan</th>
                <th>Tanggal Setor</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($setoran as $setor)
              <tr>
                <td>{{ $setor->jenis }}</td>
                <td>{{ $setor->kiloan }} kg</td>
                <td>{{ $setor->pendapatan }}</td>
                <td>{{ $setor->tanggal_setor }}</td>
                <td>
                    <a href="{{ route('setor-edit', $setor->id)}}"><button class="btn btn-xs btn-info bg-inf" type="button"><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a>
                    <a href="delete-setor/{{$setor->id}}" class="button delete-confirm"><button class="btn btn-xs btn-danger bg-bhy" type="button"><span class="btn-label"><i class="fa fa-trash"></i> Hapus</span></button></a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">
              <img src="{{URL::asset('tempAdmin')}}/dist/img/icon.png" height="50">
            </div>
            <div class="col-md-4">
              <h4 class="modal-title">Tambah Sampah</h4>
            </div>
            <div class="col-md-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
         <form action="{{ route('store') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <label>Jenis Sampah</label>
              <select name="jenis" class="form-control">
                <option value="">Pilih Jenis Sampah</option>
                @foreach($jenis as $data)
                <option value="{{ $data->jenis }}">{{ $data->jenis }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="kiloan">Kiloan</label>
              <input name="kiloan" type="text" class="form-control" id="kiloan">
            </div>
            <div class="form-group">
              <label>Penyetor</label>
              <select name="penyetor" class="form-control">
                <option value="">Pilih</option>
                @auth
                @if(Auth::user()->role_id == "1")
                @foreach($users as $users)
                <option value="{{ $users->id }}">{{ $users->name }}</option>
                @endforeach
                @else
                @foreach($userrole as $userrole)
                <option value="{{ $userrole->id }}">{{ $userrole->name }}</option>
                @endforeach
                @endif
                @endauth
              </select>
            </div>
            <input name="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
            <input name="pendapatan" type="hidden" class="form-control" >
            <input type="hidden" name="tanggal_setor" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success bg icon">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


@endsection

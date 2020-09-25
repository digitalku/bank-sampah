@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Detail User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                   <h3>Data User</h3>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
             <form role="form" method="post">
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="id" id="id" value="{{ $users->id}}">
                  <label for="name">Nama</label>
                  <input name="name" type="text" class="form-control" id="name" value="{{ $users->name}}" disabled>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input name="username" type="text" class="form-control" id="username" value="{{ $users->username}}" disabled>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" class="form-control" disabled>{{ $users->alamat}}</textarea disabled>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input name="email" type="email" class="form-control" id="email" value="{{ $users->email }}" disabled>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                   <h3>Data Sampah</h3>
                </div>
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
                    <a href="#"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-edit"></i></span></button></a>
                    <a href="#"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-trash"></i></span></button></a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
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

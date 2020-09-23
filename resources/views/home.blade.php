@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
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
            <h3 class="card-title">DataTable with default features</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>User ID</th>
                <th>Jenis</th>
                <th>Kiloan</th>
                <th>Pendapatan</th>
                <th>Tanggal Setor Sampah</th>
                <th>Action</th>
              </tr>
              </thead>
              @foreach($setoran as $setor)
              <tr>
                <td>{{ $setor->user_id }}</td>
                <td>{{ $setor->jenis }}</td>
                <td>{{ $setor->kiloan }} kg</td>
                <td>{{ $setor->pendapatan }}</td>
                <td>{{ $setor->tanggal_setor }}</td>
                <td>
                    <a href="#"><button class="btn btn-xs btn-primary " type="button"><span class="btn-label"><i class="fa fa-edit"></i></span></button></a>
                    <a href="#"><button class="btn btn-xs btn-danger " type="button"><span class="btn-label"><i class="fa fa-trash"></i></span></button></a>
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
@endsection

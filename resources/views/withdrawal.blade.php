@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Withdrawal</h1>
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
        <form id="buat-withdrawal" action="{{ route('buat-withdrawal') }}" method="POST" style="display: none">
          @csrf
          <input type="hidden" name="id" value="">
        </form>

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <div class="col-6">
                    
                </div>
              </div>
            </div>
          </div>
          <div class="card-body" style="overflow: auto;">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Jenis Sampah</th>
                <th>Kiloan</th>
                <th>Pendapatan</th>
                <th>Tanggal Setor</th>
              </tr>
              </thead>

              @foreach($storeByUser as $sbu)
              <tbody>
              <tr data-id="{{ $sbu->id }}">
                <td>{{ $sbu->jenis }}</td>
                <td>{{ $sbu->kiloan }} kg</td>
                <td>@currency($sbu->pendapatan)</td>
                <td>{{ $sbu->tanggal_setor }}</td>
              </tr>
              </tbody>
              @endforeach
            </table>
          </div>
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
            <div class="col-md-6">
              <h4 class="modal-title">Tambah User</h4>
            </div>
            <div class="col-md-6">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
         <form action="{{ route('store-user') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <label for="name">Nama</label>
              <input name="name" type="text" class="form-control" id="name" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input name="username" type="text" class="form-control" id="username" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" class="form-control"></textarea>
            </div>
           
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control" id="email" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control" id="password" autocomplete="off">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success bg-icon">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


@endsection

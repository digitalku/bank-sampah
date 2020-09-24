@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Kategori Sampah</h1>
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
              <div class="col-md-10">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-lg">
                  Tambah Data
                </button>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Tanggal Buat</th>
                <th>Action</th>
              </tr>
              </thead>
              @foreach($category as $kategori)
              <tr>
                <td>{{ $kategori->id }}</td>
                <td>{{ $kategori->jenis }}</td>
                <td>{{ $kategori->harga }} kg</td>
                <td>{{ $kategori->tanggal_buat }}</td>
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
        <h4 class="modal-title">Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="{{ route('store-category') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <div class="form-group">
                <label for="jenis">Nama Jenis</label>
                <input name="jenis" type="text" class="form-control" id="jenis">
              </div>
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input name="harga" type="number" class="form-control" id="harga">
            </div>
            <input type="hidden" name="tanggal_buat" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

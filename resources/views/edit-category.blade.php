@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Data Category</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('category') }}">Kategori</a></li>
          <li class="breadcrumb-item active">Edit Data Category</li>
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
             <form action="{{ route('category-update') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <input class="form-control" type="hidden" name="id" id="id" value="{{ $category->id}}">
              <label for="jenis">Jenis</label>
              <input name="jenis" type="text" class="form-control" id="jenis" value="{{ $category->jenis}}">
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input name="harga" type="text" class="form-control" id="harga" value="{{ $category->harga}}">
            </div>
            <input type="hidden" name="tanggal_buat" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
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

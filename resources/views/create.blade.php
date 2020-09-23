@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Sampah</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('store') }}" role="form" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Select</label>
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
                  <input name="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
                  <input name="pendapatan" type="hidden" class="form-control" >
                  <input type="hidden" name="tanggal_setor" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

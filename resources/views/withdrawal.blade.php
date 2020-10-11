@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ubah Rekening dan Password</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Ubah Rekening dan Password</li>
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

        <div class="card card-success">
          <div class="card-body">
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
             <form action="{{ route('set-withdrawal') }}" role="form" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <input name="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
                  <input class="form-control" type="hidden" name="penyetor" id="penyetor" value="{{ $users->id}}">
                  <input type="hidden" name="name" class="form-control" value="{{ $users->name }}">
                  <label for="pendapatan">Ajukan Withdrawal</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rp</div>
                    </div>
                    <input type="number" name="pendapatan" class="form-control" id="inlineFormInputGroup" placeholder="0">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-success bg icon">Kirim</button>
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

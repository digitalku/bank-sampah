@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Data User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Edit Data User</li>
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
             <form action="{{ route('users-update') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            @if (session('status'))
                    <div class="alert alert-info alert-disabled fade show bg-icon" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
            <div class="form-group">
              <input class="form-control" type="hidden" name="id" id="id" value="{{ $users->id}}">
              <label for="name">Nama</label>
              <input name="name" type="text" class="form-control" id="name" value="{{ $users->name}}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input name="username" type="text" class="form-control" id="username" value="{{ $users->username}}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" class="form-control">{{ $users->alamat}}</textarea>
            </div>
            <div class="form-group">
              <label>Hak Akses Sebagai</label>
              <select name="role_id" class="form-control">
                <option value="">Pilih</option>
                @foreach($roles as $data)
                  @if($data->id == $users->role_id)
                  <option value="{{ $data->id }}" selected>{{ $data->name }}</option>
                  @else
                  <option value="{{ $data->id }}">{{ $data->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control" id="email" value="{{ $users->email }}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="text" class="form-control" id="password" placeholder="masukkan password" autocomplete="off">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success bg-icon">Update</button>
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

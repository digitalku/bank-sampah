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
            <div class="form-group">
              <input class="form-control" type="hidden" name="id" id="id" value="{{ $users->id}}">
              <label for="name">Nama</label>
              <input name="name" type="text" class="form-control" id="name" value="{{ $users->name}}">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input name="username" type="text" class="form-control" id="username" value="{{ $users->username}}">
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
              <input name="email" type="email" class="form-control" id="email" value="{{ $users->email }}">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control" id="password" value="{{ $users->password }}">
            </div>
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

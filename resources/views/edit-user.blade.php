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
              <h6 style="font-size: 15px;">Keterangan : Tanda <span class="text-danger">*</span> Wajib diisi</h6>
            </div>
            <div class="form-group">
              <input class="form-control" type="hidden" name="id" id="id" value="{{ $users->id}}">
              <label for="name">Nama <span class="text-danger">*</span></label>
              <input name="name" type="text" class="form-control" id="name" value="{{ $users->name}}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="username">Username <span class="text-danger">*</span></label>
              <input name="username" type="text" class="form-control" id="username" value="{{ $users->username}}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat <span class="text-danger">*</span></label>
              <textarea name="alamat" class="form-control">{{ $users->alamat}}</textarea>
            </div>
            <div class="form-group">
              <label>Hak Akses Sebagai <span class="text-danger">*</span></label>
              <select name="role_id" class="form-control" required>
                <option value="">Pilih</option>
                
                @foreach($role as $role)
                  @if($role->id == $users->role_id)
                  <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                  @else
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control" id="email" value="{{ $users->email }}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="rekening">Nomor Rekening (contoh: bca#123456#agusrohma)</label>
              <input name="rekening" type="text" class="form-control" id="rekening" value="{{ $users->rekening }}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control" id="password" placeholder="masukkan password" autocomplete="off">
              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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

@section('script')
<script>
  $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });
</script>
@endsection

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
          <li class="breadcrumb-item active">Edit Profil</li>
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
              <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $users->name)}}" autocomplete="off">
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="username">Username <span class="text-danger">*</span></label>
              <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username', $users->username)}}" autocomplete="off">
              @error('username')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="alamat">Alamat <span class="text-danger">*</span></label>
              <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $users->alamat)}}</textarea>
              @error('alamat')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label>Hak Akses Sebagai <span class="text-danger">*</span></label>
              <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                <option value="">Pilih</option>
                @auth
                @if(Auth::user()->role_id == "1")
                @foreach($roles as $data)
                  @if($data->id == $users->role_id)
                  <option value="{{ $data->id }}" selected>{{ $data->name }}</option>
                  @else
                  <option value="{{ $data->id }}">{{ $data->name }}</option>
                  @endif
                @endforeach
                @elseif(Auth::user()->role_id == "2")
                @foreach($rolepetugas as $rolepetugas)
                  @if($rolepetugas->id == $users->role_id)
                  <option value="{{ $rolepetugas->id }}" selected>{{ $rolepetugas->name }}</option>
                  @else
                  <option value="{{ $rolepetugas->id }}">{{ $rolepetugas->name }}</option>
                  @endif
                @endforeach
                @else
                @foreach($role as $role)
                  @if($role->id == $users->role_id)
                  <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                  @else
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                  @endif
                @endforeach
                @endif
                @endauth
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email <span class="text-danger">*</span></label>
              <input name="email" type="email" class="form-control" id="email" value="{{ old('email', $users->email) }}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="rekening">Nomor Rekening (contoh: bca#123456#agusrohma)</label>
              <input name="rekening" type="text" class="form-control" id="rekening" value="{{ old('rekening', $users->rekening) }}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="password">Ubah Password? <a onclick="showhidden()" class="text-info">Klik Disini</a></label>
              <input name="password" type="password" class="form-control" id="password" placeholder="masukkan password baru" autocomplete="off" style="display: none;">
              <span id="eye" toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="display: none;"></span>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success bg-icon">Edit</button>
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
  function showhidden() {
    var x = document.getElementById("password");
    var y = document.getElementById("eye");
    if (x.style.display === "block") {
      x.style.display = "none";
      y.style.display = "none";
    } else {
      x.style.display = "block";
      y.style.display = "block";
    }
  }
</script>
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

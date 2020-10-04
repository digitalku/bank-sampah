@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Utama</h1>
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
            <div class="row">
              <div class="col-md-10">
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
              </div>
              @auth
              @if(Auth::user()->role_id == "1")
              <div class="col-md-2">
                <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                  Tambah User
                </button>
              </div>
              @elseif(Auth::user()->role_id == "2")
              <div class="col-md-2">
                <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                  Tambah User
                </button>
              </div>
              @else
              <div class="col-md-2">
                <h3>Daftar Sampah</h3>
              </div>
              @endif
              @endauth
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="overflow: auto;">
            <table id="example1" class="table table-bordered table-hover">
              
              @auth
              @if(Auth::user()->role_id == "1")
              <thead>
              <tr>
                <th>Name</th>
                <th>Alamat</th>
                <th>Username</th>
                <th>Action</th>
              </tr>
              </thead>

              @foreach($users as $user)
              <tbody>
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->alamat }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    <a href="{{ route('users-edit', $user->id)}}"><button class="btn btn-xs btn-info bg-inf" type="button"><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a>
                    <a href="delete-user/{{$user->id}}" class="button delete-confirm"><button class="btn btn-xs btn-danger bg-bhy" type="button"><span class="btn-label"><i class="fa fa-trash"></i> Hapus</span></button></a>
                    <a href="{{ route('users-lihat', $user->id)}}"><button class="btn btn-xs btn-warning bg-wrning" type="button"><span class="btn-label"><i class="fa fa-eye"></i> Lihat</span></button></a>
                </td>
              </tr>
              </tbody>
              @endforeach
              @elseif(Auth::user()->role_id == "2")
              <thead>
              <tr>
                <th>Name</th>
                <th>Alamat</th>
                <th>Username</th>
                <th>Action</th>
              </tr>
              </thead>

              @foreach($userrole as $userrole)
              <tbody>
              <tr>
                <td>{{ $userrole->name }}</td>
                <td>{{ $userrole->alamat }}</td>
                <td>{{ $userrole->username }}</td>
                <td>
                    <a href="{{ route('users-edit', $userrole->id)}}"><button class="btn btn-xs btn-info bg-inf" type="button"><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a>
                    <a href="delete-user/{{$userrole->id}}" class="button delete-confirm"><button class="btn btn-xs btn-danger bg-bhy" type="button"><span class="btn-label"><i class="fa fa-trash"></i> Hapus</span></button></a>
                    <a href="{{ route('users-lihat', $userrole->id)}}"><button class="btn btn-xs btn-warning bg-wrning" type="button"><span class="btn-label"><i class="fa fa-eye"></i> Lihat</span></button></a>
                </td>
              </tr>
              </tbody>
              @endforeach
              @else
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
              <tr>
                <td>{{ $sbu->jenis }}</td>
                <td>{{ $sbu->kiloan }} kg</td>
                <td>@currency($sbu->pendapatan)</td>
                <td>{{ $sbu->tanggal_setor }}</td>
              </tr>
              </tbody>
              @endforeach
              @endif
              @endauth
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
              <label>Hak Akses Sebagai</label>
              <select name="role_id" class="form-control">
                <option value="">Pilih</option>
                @auth
                @if(Auth::user()->role_id == "1")
                @foreach($roles as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
                @else
                @foreach($role as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
                @endif
                @endauth
              </select>
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
<!-- /.modal -->
@endsection

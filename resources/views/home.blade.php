@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
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
                    <div class="alert alert-info alert-disabled fade show" role="alert">
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
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                  Tambah User
                </button>
              </div>
              @elseif(Auth::user()->role_id == "2")
              <div class="col-md-2">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                  Tambah User
                </button>
              </div>
              @else
              <div class="col-md-2">
                <h3>Your Trash</h3>
              </div>
              @endif
              @endauth
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
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
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->alamat }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    <a href="{{ route('users-edit', $user->id)}}"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-edit"></i></span></button></a>
                    <a href="#"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-trash"></i></span></button></a>
                    <a href="{{ route('users-lihat', $user->id)}}"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-eye"></i></span></button></a>
                </td>
              </tr>
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
              <tr>
                <td>{{ $userrole->name }}</td>
                <td>{{ $userrole->alamat }}</td>
                <td>{{ $userrole->username }}</td>
                <td>
                    <a href="{{ route('users-edit', $userrole->id)}}"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-edit"></i></span></button></a>
                    <a href="#"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-trash"></i></span></button></a>
                    <a href="{{ route('users-lihat', $userrole->id)}}"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-eye"></i></span></button></a>
                </td>
              </tr>
              @endforeach
              @else
              <thead>
              <tr>
                <th>Jenis Sampah</th>
                <th>Kiloan</th>
                <th>Pendapatan</th>
                <th>Tanggal Setor</th>
                <th>Action</th>
              </tr>
              </thead>

              @foreach($setoran as $setor)
              <tr>
                <td>{{ $setor->jenis }}</td>
                <td>{{ $setor->kiloan }} kg</td>
                <td>{{ $setor->pendapatan }}</td>
                <td>{{ $setor->tanggal_setor }}</td>
                <td>
                    <a href="#"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-edit"></i></span></button></a>
                    <a href="#"><button class="btn btn-xs btn-info " type="button"><span class="btn-label"><i class="fa fa-trash"></i></span></button></a>
                </td>
              </tr>
              @endforeach
              @endif
              @endauth
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
         <form action="{{ route('store-user') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <label for="name">Nama</label>
              <input name="name" type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input name="username" type="text" class="form-control" id="username">
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
              <input name="email" type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control" id="password">
            </div>
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
<!-- /.modal -->
@endsection

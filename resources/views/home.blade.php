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
              <div class="col-md-8">
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
              <div class="col-md-4 text-right">
                <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                  Tambah User
                </button>
              </div>
              @elseif(Auth::user()->role_id == "2")
              <div class="col-md-4 text-right">
                <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                  Tambah User
                </button>
              </div>
              @else
              <div class="col-md-4 text-right">
                <h3>Daftar Sampah</h3>
              </div>
              @endif
              @endauth
            </div>
          </div>
              
              @auth
              @if(Auth::user()->role_id == "1")
          <!-- /.card-header -->
          <div class="card-body" style="overflow: auto;">
            <table id="config-tableadmin" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Username</th>
                <th>Action</th>
              </tr>
              </thead>

              {{--@foreach($users as $user)
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
              @endforeach--}}

            </table>
          </div>
              @elseif(Auth::user()->role_id == "2")
          <div class="card-body" style="overflow: auto;">
            <table id="config-tablepetugas" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Username</th>
                <th>Action</th>
              </tr>
              </thead>

              {{--@foreach($userrole as $userrole)
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
              @endforeach--}}
            </table>
          </div>
              @else
          
          <div class="card-body" style="overflow: auto;">
            <table id="config-table-users" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Jenis Sampah</th>
                <th>Kiloan</th>
                <th>Pendapatan</th>
                <th>Tanggal Setor</th>
              </tr>
              </thead>

              {{--@foreach($storeByUser as $sbu)
              <tbody>
              <tr>
                <td>{{ $sbu->jenis }}</td>
                <td>{{ $sbu->kiloan }} kg</td>
                <td>@currency($sbu->pendapatan)</td>
                <td>{{ $sbu->tanggal_setor }}</td>
              </tr>
              </tbody>
              @endforeach--}}
              <tfoot>
                <tr>
                  <th style="border-right: none;">Total Pendapatan</th>
                  <th></th>
                  <th style="border-right: none;">@currency($hitung)</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
              @endif
              @endauth
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
            <div class="form-group">
              <label for="rekening">Nomor Rekening</label>
              <input name="rekening" type="number" class="form-control" id="rekening" autocomplete="off">
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

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <h3 class="heading text-danger">Konfirmasi</h3>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-exclamation-circle fa-4x mb-4"></i>

        <p>Yakin Ingin Menghapus Data ini? Data yang telah terhapus tidak dapat dikembalikan lagi!</p>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Hapus</button>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

<!-- /.modal -->
@endsection

@section('script')

<script>

     var id;

     $(document).on('click', '.delete', function(){
      id = $(this).attr('id');
      $('#confirmModal').modal('show');
     });

     $('#ok_button').click(function(){
      $.ajax({
       url:"delete/users/"+id
      }).then()
        $('#confirmModal').modal('hide');
        $('#config-tablepetugas').DataTable().ajax.reload();
     });
    $(document).ready(function() {
        $('#exp_date').hide();
        $('#labelexp').hide();
        $("#cb_expdate").change(function(){
            if($(this).is(':checked')){
                $('#exp_date').show();
                $('#labelexp').show();
            }else{
                $('#exp_date').hide();
                $('#labelexp').hide();
            }
        });
    });
    $(document).ready(function() {
        var i=0;
        var table=$('#config-tableadmin').DataTable({
            processing: true,
            serverSide: true,
            "ajax": "{{ route('list-users-admin') }}",
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
              {data: 'name', name: 'name'},
              {data: 'alamat', name: 'alamat'},
              {data: 'username', name: 'username'},
              {data: 'action', name: 'action'},
            ],
        });
    });
    $(document).ready(function() {
        var i=0;
        var table=$('#config-tablepetugas').DataTable({
            processing: true,
            serverSide: true,
            "ajax": "{{ route('list-users-petugas') }}",
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
              {data: 'name', name: 'name'},
              {data: 'alamat', name: 'alamat'},
              {data: 'username', name: 'username'},
              {data: 'action', name: 'action'},
            ],
        });
    });
    $(document).ready(function() {
        var i=0;
        var table=$('#config-table-users').DataTable({
            processing: true,
            serverSide: true,
            "ajax": "{{ route('list-setor-users') }}",
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
              {data: 'jenis', name: 'jenis'},
              {data: 'kiloan', name: 'kiloan'},
              {data: 'pendapatan', name: 'pendapatan'},
              {data: 'tanggal_setor', name: 'tanggal_setor'},
            ],
        });
    });
</script>
@endsection
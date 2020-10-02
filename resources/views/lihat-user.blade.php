@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Detail User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Detail User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<form id="set-setoran" action="{{ route('set-setoran') }}" method="POST" style="display: none">
  @csrf
  <input type="hidden" name="id" value="">
</form>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                   <h3>Data User</h3>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="card-body">
                  <div class="form-group">
                    <img src="{{URL::asset('tempAdmin')}}/dist/img/avatar5.png">
                  </div>
                </div> 
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <div class="form-group">
                    <input class="form-control" type="hidden" name="id" id="id" value="{{ $users->id}}">
                    <div class="row">
                      <div class="col-md-4"><h5 for="name">Nama</h5></div>
                      <div class="col-md-7"><h5 for="name">: {{ $users->name}}</h5></div>
                    </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                      <div class="col-md-4"><h5 for="username">Username</h5></div>
                      <div class="col-md-7"><h5 for="username">: {{ $users->username}}</h5></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4"><h5 for="alamat">Alamat</h5></div>
                      <div class="col-md-7"><h5 for="alamat">: {{ $users->alamat}}</h5></div>
                    </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                      <div class="col-md-4"><h5 for="email">Email</h5></div>
                      <div class="col-md-7"><h5 for="email">: {{ $users->email}}</h5></div>
                    </div>
                  </div>
                   <div class="form-group">
                     <div class="row">
                      <div class="col-md-4"><h5 for="email">Total Pendapatan</h5></div>
                      <div class="col-md-7"><h5 for="email">: @currency($hitung)</h5></div>
                    </div>
                  </div>
                </div>              
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                   <h3>Data Sampah</h3>
                   <div class="row">
                     <div class="col-md-4">
                        @if (session('status'))
                        <div class="alert alert-info alert-disabled fade show bg-icon" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif   
                     </div>
                     <div class="col-md-8 text-right">
                        <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lgi">
                          Tambah Sampah
                        </button>
                     </div>
                   </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="overflow: auto;">
            <table id="datatables-sampah" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Jenis Sampah</th>
                <th>Kiloan</th>
                <th>Pendapatan</th>
                <th>Tanggal Setor</th>
                <!-- <th>Action</th> -->
              </tr>
              </thead>
              <tbody>
              @foreach($setoran as $setor)
              <tr data-id="{{ $setor->id }}">
                <td>{{ $setor->jenis }}</td>
                <td>{{ $setor->kiloan }} kg</td>
                <td>
                  @if($setor->pendapatan==null)
                  <button class="btn btn-info hitung-pendapatan" type="button">Hitung Pendapatan </button>
                  @else
                  @currency($setor->pendapatan)
                  @endif
                </td>
                <td>{{ $setor->tanggal_setor }}</td>
               <!--  <td>
                    <button class="btn btn-xs btn-info bg-inf" type="button" data-toggle="modal" data-target-id="{{ $setor->id }}" data-target-userid="{{ $setor->user_id }}" data-target-jenis="{{ $setor->jenis }}" data-target-pendapatan="{{ $setor->pendapatan }}"  data-target-penyetor="{{ $setor->penyetor }}" data-target-kiloan="{{ $setor->kiloan }}" data-target-tgl="{{ $setor->tanggal_setor }}" data-target="#modal-lgt"><i class="fa fa-edit"></i> Edit</span> </button>
                    <a href="{{ route('setor-edit', $setor->id)}}"><button class="btn btn-xs btn-info bg-inf" type="button" ><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a>
                    <a href="delete-setoruser/{{$setor->id}}" class="button delete-confirm"><button class="btn btn-xs btn-danger bg-bhy" type="button"><span class="btn-label"><i class="fa fa-trash"></i> Hapus</span></button></a>
                </td> -->
              </tr>
              @endforeach
              </tbody>
            </table>
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


<div class="modal fade" id="modal-lgi">
  <div class="modal-dialog modal-lgi">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <h5 class="modal-title">Tambah Sampah</h5>
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
        <form action="{{ route('storeWithUser') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <label>Jenis Sampah</label>
              <select name="jenis" class="form-control">
                <option value="">Pilih Jenis Sampah</option>
                @foreach($jenis as $data)
                <option value="{{ $data->jenis }}">{{ $data->jenis }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="kiloan">Kiloan</label>
              <input name="kiloan" type="text" class="form-control" id="kiloan" autocomplete="off">
            </div>
            <input class="form-control" type="hidden" name="penyetor" id="penyetor" value="{{ $users->id}}">
            <input name="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
            <input name="pendapatan" type="hidden" class="form-control" >
            <input type="hidden" name="tanggal_setor" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success bg icon">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-sm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hitung Pendapatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('pendapatan-update') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
              <input class="form-control" name="id" type="hidden" id="pass_id">
            <div class="form-group">
              <label>Jenis Sampah</label>
              <input class="form-control" name="jenis" type="text" id="jenis">
            </div>
            <div class="form-group">
              <label>Kiloan</label>
              <input class="form-control" name="kiloan" type="text" id="kiloann" >
            </div>
            <input class="form-control" name="pendapatan" type="hidden" id="total" >
            <input name="user_id" id="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
            <input class="form-control" name="penyetor" type="hidden" id="penyetorr" >
            <input type="hidden" id="tgl" name="tanggal_setor" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success bg icon">Ubah</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


@endsection

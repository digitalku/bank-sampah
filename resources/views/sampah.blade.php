@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Seluruh Sampah User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Sampah</li>
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
              <div class="col-md-2">
                <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                  Tambah Sampah
                </button>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="overflow: auto;">
            <table id="example1" class="table table-bordered table-hover"> 
              <thead>
              <tr>
                <th>Jenis Sampah</th>
                <th>Kiloan</th>
                <th>Pendapatan</th>
                <th>Tanggal Setor</th>
                <th>Penyetor</th>
                <!-- <th>Action</th> -->
              </tr>
              </thead>
              <tbody>
              {{--@foreach($setoran as $setor)
              <tr>
                <td>{{ $setor->jenis }}</td>
                <td>{{ $setor->kiloan }} kg</td>
                <td>@currency( $setor->pendapatan )</td>
                <td>{{ $setor->tanggal_setor }}</td>
                <td>
                  @if($setor->name==null)
                    <p class="text-danger">User Tidak Terdaftar</p>
                  @else
                  {{ $setor->name }}
                  @endif
                </td>
                 <td>
                    <a href="{{ route('setor-edit', $setor->id)}}"><button class="btn btn-xs btn-info bg-inf" type="button"><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a>
                    <a href="delete-setor/{{$setor->id}}" class="button delete-confirm"><button class="btn btn-xs btn-danger bg-bhy" type="button"><span class="btn-label"><i class="fa fa-trash"></i> Hapus</span></button></a>
                </td>
              </tr>
              @endforeach--}}
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
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <h4 class="modal-title">Tambah Sampah</h4>
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
         <form action="{{ route('store') }}" role="form" method="post">
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
            <div class="form-group">
              <label>Penyetor</label>
              <select name="penyetor" class="form-control">
                <option value="">Pilih</option>
                @auth
                @if(Auth::user()->role_id == "1")
                @foreach($users as $users)
                <option value="{{ $users->id }}">{{ $users->name }}</option>
                @endforeach
                @else
                @foreach($userrole as $userrole)
                <option value="{{ $userrole->id }}">{{ $userrole->name }}</option>
                @endforeach
                @endif
                @endauth
              </select>
            </div>
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


@endsection
@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="
https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>

<script>

    $(document).ready(function() {

        setoran = $("#id").val()
        var i=0;
        var table=$('.table-hover').DataTable({
            dom: "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { extend: 'excel', className: 'btn btn-primary btn-xs mb-3' },
                { extend: 'pdf', className: 'btn btn-primary btn-xs mb-3' },
                { extend: 'print', className: 'btn btn-primary btn-xs mb-3' }
            ],
            processing: true,
            serverSide: true,
             "ajax": "/list-sampah/",
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
              {data: 'jenis', name: 'jenis'},
              {data: 'kiloan', name: 'kiloan'},
              {data: 'pendapatan', name: 'pendapatan'},
              {data: 'tanggal_setor', name: 'tanggal_setor'},
              {data: 'name', name: 'name'},
            ],
        });
    });
</script>
@endsection


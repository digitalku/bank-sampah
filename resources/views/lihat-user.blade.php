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

<form id="approve" action="{{ route('approve') }}" method="POST" style="display: none">
  @csrf
  <input type="hidden" name="id" value="">
  <input type="hidden" name="penerima" class="form-control" id="inlineFormInputGroup" placeholder="email" value="{{ $users->email }}">
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
                      <div class="col-md-4"><h5 for="rekening">Nomor Rekening</h5></div>
                      <div class="col-md-7"><h5 for="rekening">: {{ $users->rekening}}</h5></div>
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
                        <div class="alert alert-info alert-disabled fade show bg-sukses" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif   
                      </div>
                      <div class="col-md-4">
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                          Withdrawal
                      </button>
                      </div>
                     <div class="col-md-2">
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
                <th>Tanggal Setor</th>
                <th>Pendapatan</th>
              </tr>
              </thead>
              <tbody>
              {{--@foreach($setoran as $setor)
              <tr data-id="{{ $setor->id }}">
                <td>{{ $setor->jenis }}</td>
                <td>{{ $setor->kiloan }} kg</td>
                <td>
                  @if($setor->pendapatan==null)
                  <button class="btn btn-info hitung-pendapatan" type="button">Hitung Pendapatan </button>
                  @elseif($setor->jenis=="withdrawal" && $setor->approved==null)
                  @currency($setor->pendapatan) <button class="btn btn-warning approve" type="button"> Approve</button>
                  @elseif($setor->jenis=="withdrawal" && $setor->approved==1)
                  @currency($setor->pendapatan) <span class="badge badge-success"> Approved</span>
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
              @endforeach--}}
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
            <input class="form-control" type="hidden" name="tanggal_setor" id="tanggal_setor">
            <input name="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
            <input name="pendapatan" type="hidden" class="form-control" >
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


<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <h5 class="modal-title">Withdrawal</h5>
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
        <form action="{{ route('set-withdrawal') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <input name="user_id" type="hidden" class="form-control" value="{{ auth()->user()->id }}" >
              <input class="form-control" type="hidden" name="penyetor" id="penyetor" value="{{ $users->id}}">
              <label for="pendapatan">Pendapatan</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">Rp</div>
                </div>
                <input type="number" name="pendapatan" class="form-control" id="inlineFormInputGroup" placeholder="0">
                <input type="hidden" name="penerima" class="form-control" id="inlineFormInputGroup" placeholder="email" value="{{ $users->email }}">
                <input type="hidden" class="form-control" name="pesan" value="hello selamat anda mendapatkan rezeki nomplok"></input>
              </div>
            </div>
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
        var table = $('#datatables-sampah').DataTable({
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
             "ajax": "/list-setor-byusers/" + setoran,
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
              {data: 'jenis', name: 'jenis'},
              {data: 'kiloan', name: 'kiloan'},
              {data: 'tanggal_setor', name: 'tanggal_setor'},
              {data: 'pendapatan', name: 'pendapatan'},
            ],
        });

        $('#datatables-sampah tbody').on('click', 'td .hitung-pendapatan', function () {
            var tr = $(this).closest('tr');
            var data = table.row( tr ).data();
            
            var elFormSetSetoran = $("#set-setoran");

            if (!data.id && !elFormSetSetoran) return;

            var elInputName = elFormSetSetoran.find("input[name='id']");
            elInputName.val(data.id);
            elFormSetSetoran.submit();
        } );

        $('#datatables-sampah tbody').on('click', 'td .approve', function () {
            var tr = $(this).closest('tr');
            var data = table.row( tr ).data();
            
            var elFormSetSetoran = $("#approve");

            if (!data.id && !elFormSetSetoran) return;

            var elInputName = elFormSetSetoran.find("input[name='id']");
            elInputName.val(data.id);
            elFormSetSetoran.submit();
        } );
    });
</script>
@endsection

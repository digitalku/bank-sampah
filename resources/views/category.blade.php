@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Kategori Sampah</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

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
                <button type="button" class="btn btn-block btn-success bg-icon" data-toggle="modal" data-target="#modal-lg">
                  Tambah Data
                </button>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="overflow: auto;">
            <table id="table-category" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Tanggal Buat</th>
                <th>Action</th>
              </tr>
              </thead>
              {{--@foreach($category as $kategori)
              <tr>
                <td>{{ $kategori->id }}</td>
                <td>{{ $kategori->jenis }}</td>
                <td>{{ $kategori->harga }} kg</td>
                <td>{{ $kategori->tanggal_buat }}</td>
                <td>
                    <a href="{{ route('edit-category', $kategori->id)}}"><button class="btn btn-xs btn-info bg-inf" type="button"><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a>
                    <a href="delete-category/{{$kategori->id}}" class="button delete-confirm"><button class="btn btn-xs btn-danger bg-bhy" type="button"><span class="btn-label"><i class="fa fa-trash"></i> Hapus</span></button></a>
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
              <h4 class="modal-title">Tambah Kategori Sampah</h4>
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
         <form action="{{ route('store-category') }}" role="form" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <div class="form-group">
                <label for="jenis">Nama Jenis</label>
                <input name="jenis" type="text" class="form-control" id="jenis" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input name="harga" type="number" class="form-control" id="harga" autocomplete="off">
            </div>
            <input type="hidden" name="tanggal_buat" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
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

     var id;

     $(document).on('click', '.delete', function(){
      id = $(this).attr('id');
      $('#confirmModal').modal('show');
     });

     $('#ok_button').click(function(){
      $.ajax({
       url:"delete-category/"+id
      }).then()
        $('#confirmModal').modal('hide');
        $('#table-category').DataTable().ajax.reload();
     });

    $(document).ready(function() {

        setoran = $("#id").val()
        var i=0;
        var table = $('#table-category').DataTable({
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
             "ajax": "/list-category/",
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
              {data: 'id', name: 'id'},
              {data: 'jenis', name: 'jenis'},
              {data: 'harga', name: 'harga'},
              {data: 'tanggal_buat', name: 'tanggal_buat'},
              {data: 'action', name: 'action'},
            ],
        });
    });
</script>
@endsection


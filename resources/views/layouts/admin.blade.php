<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{URL::asset('tempAdmin')}}/dist/img/icon.png">
  <title>{{ config('app.name', 'Bank Sampah') }}</title>
  
  <link rel="apple-touch-icon" sizes="57x57" href="https://img.bsdrajat.nix.id/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="https://img.bsdrajat.nix.id/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="https://img.bsdrajat.nix.id/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="https://img.bsdrajat.nix.id/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="https://img.bsdrajat.nix.id/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="https://img.bsdrajat.nix.id/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="https://img.bsdrajat.nix.id/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://img.bsdrajat.nix.id/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="https://img.bsdrajat.nix.id/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="https://img.bsdrajat.nix.id/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://img.bsdrajat.nix.id/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="https://img.bsdrajat.nix.id/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://img.bsdrajat.nix.id/icon/favicon-16x16.png">
<link rel="manifest" href="https://img.bsdrajat.nix.id/icon/manifest.json">
<meta name="msapplication-TileColor" content="green">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="green">
  
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- Toastr -->
  <link rel="stylesheet" href="{{URL::asset('tempAdmin')}}/plugins/toastr/toastr.min.css">
  
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <style type="text/css">
    .bg-icon{
      background-color: #039b4e;
      border-color: #039b4e;
    }
    .bg-bhy{
      background-color: #f21711;
      border-color: #f21711;
    }
    .bg-inf{
      background-color: #0099e5;
      border-color: #0099e5;
    }
    .bg-wrning{
      background-color: #ccaa00;
      border-color: #ccaa00;
      color: white;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts/header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts/footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{URL::asset('tempAdmin')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('tempAdmin')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{URL::asset('tempAdmin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{URL::asset('tempAdmin')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{URL::asset('tempAdmin')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{URL::asset('tempAdmin')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{URL::asset('tempAdmin')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::asset('tempAdmin')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{URL::asset('tempAdmin')}}/plugins/moment/moment.min.js"></script>
<script src="{{URL::asset('tempAdmin')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{URL::asset('tempAdmin')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{URL::asset('tempAdmin')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{URL::asset('tempAdmin')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('tempAdmin')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL::asset('tempAdmin')}}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('tempAdmin')}}/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="{{URL::asset('tempAdmin')}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{URL::asset('tempAdmin')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="{{URL::asset('tempAdmin')}}/plugins/select2/js/select2.full.min.js"></script>
<!-- Toastr -->
<script src="{{URL::asset('tempAdmin')}}/plugins/toastr/toastr.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>

<script>
  $('tr[data-href]').on("click", function() {
      document.location = $(this).data('href');
  });
</script>

<script src="{{URL::asset('js')}}/sweetalert.min.js"></script>
<script>
$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Apakah Kamu Yakin?',
        text: 'Data yang Sudah di Hapus Tidak dapat dikembalikan lagi!',
        icon: 'warning',
        buttons: ["Batal", "Ya!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
  
</script>

<!-- edit with modal -->
<script>
  $(document).on('ajaxComplete ready', function () {
    $('.modalMd').off('click').on('click', function () {
        $('#modalMdContent').load($(this).attr('value'));
        $('#modalMdTitle').html($(this).attr('title'));
    });
});
</script>

 <script>
    $(document).ready(function () {
        $("#modal-lgt").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('target-id');
            var jenis = $(e.relatedTarget).data('target-jenis');
            var kiloan = $(e.relatedTarget).data('target-kiloan');
            var total = $(e.relatedTarget).data('target-pendapatan');
            var userid = $(e.relatedTarget).data('target-userid');
            var penyetor = $(e.relatedTarget).data('target-penyetor');
            var tgl = $(e.relatedTarget).data('target-tgl');
            $('#pass_id').val(id);
            $('#jenis').val(jenis);
            $('#kiloann').val(kiloan);
            $('#total').val(total);
            $('#user_id').val(userid);
            $('#penyetorr').val(penyetor);
            $('#tgl').val(tgl);
        });
    });

</script>

<script>
    $(document).ready(function () {
        var elButtons = $("#datatables-sampah .hitung-pendapatan");
        var elFormSetSetoran = $("#set-setoran");

        if (!elButtons || !elFormSetSetoran) return;

        elButtons.click(function() {
          var id = $(this).closest("tr").data('id');
          if (!id) return;

          var elInputName = elFormSetSetoran.find("input[name='id']");
          elInputName.val(id);
          elFormSetSetoran.submit();
        });
    });

</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard - Biro Kerjasama, Pembangunan dan Rantau</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.min.css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  

  <div id="wrapper">

    <!-- Sidebar -->
    <?php echo !empty($menu_sidebar) ? $menu_sidebar : '' ; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
          <!-- Card Header Title -->
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Agenda
          </div>
          <!-- End Card Header Title -->
          <!-- Card Body Table Agenda -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered agenda" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th width="15%" style="text-align: center;">Pejabat</th>
                    <th style="text-align: center;">Agenda</th>
                    <th width="10%" style="text-align: center;">Hari/Tanggal</th>
                    <th width="1%" style="text-align: center;">Jam</th>
                    <th width="10%" style="text-align: center;">Tempat</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <!-- End Card Body Table Agenda -->
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <!-- <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script> -->
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
  <!-- select2 -->
  <script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.full.min.js"></script>
  <script>
    $(document).ready(function() {
      showAgenda();
    });

    // Fungsi untuk menampilkan Jabatan dari v_agenda
    function showAgenda(){
      $('.agenda').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            // "order": [], //Initial no order.
            "bDestroy": true,
            "responsive": true,
     
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url('agendaku/dataTable_agenda')?>",
                "type": "POST",
                "data": {
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                },
            },
      });
    }
  </script>
</body>

</html>
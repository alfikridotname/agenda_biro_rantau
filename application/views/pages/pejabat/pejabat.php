<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /><!-- DataTables Example -->
<div class="card mb-3">
  <!-- Card Header Title -->
  <div class="card-header">
    <i class="fas fa-table"></i>
    Data Pejabat
  </div>
  <!-- End Card Header Title -->
  <!-- Card Body Table Pejabat -->
  <div class="card-body">
    <?php echo $this->session->flashdata('pesan') ?>
  	<button class="btn btn-primary" onclick="tambahPejabat()">Tambah Data</button>
  	<hr>
    <div class="table-responsive">
      <table class="table table-bordered pejabat" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          	<th width="1%">No</th>
            <th>Pejabat</th>
            <th>Jabatan</th>
            <th width="1%">Status</th>
            <th width="10%">Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- End Card BOdy Table Pejabat -->
  <!-- Modal Tambah Pejabat -->
  <div class="modal" id="modal-pejabat" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="#" id="form-pejabat">
            <div class="form-group">
              <input type="text" class="form-control" id="nama_asn" name="nama_asn" autocomplete="off" placeholder="Nama Pejabat">
            </div>
            <div class="form-group">
              <label for="jabatan_asn">Jabatan</label>
              <select class="form-control" id="jabatan_asn" name="jabatan_asn" style="width: 100%;">
                <?php $data_jabatan_asn = [
                  'Kepala Biro Administrasi Pembangunan', 
                  'Kepala Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Daerah',
                  'Kepala Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah',
                  'Kepala Bagian Pelaporan Pelaksanaan Pembangunan',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan APBD',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan APBN',
                  'Kepala Sub Bagian Tata Usaha',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah I',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah II',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah III',
                  // 'Kepala Sub Bagian Analisis Capaian Kinerja Pembangunan Daerah',
                  // 'Kepala Sub Bagian Kebijakan Pembangunan Daerah',
                  // 'Kepala Sub Bagian Pelaporan Pelaksanaan Pembangunan Daerah',
                  'Perencana Ahli Muda',
                  'Analis Kebijakan Ahli Muda',
                  'Analis Pembangunan',
                  'Staf Tata Usaha',
                  'Penyusun Laporan Keuangan',
                  'Pranata Komputer',
                  'Pengadministrasi Umum',
                  'Penyusun Program, Anggaran dan Laporan',
                  'Sopir',
                  'Tenaga Ahli Web Programmer',
                  
                  'Eselon III', 'Eselon IV', 'Seluruh Staf', 'Staff Terkait', 'PLH Kabag Pembangunan','Semua Kabag','Semua Kasubag','Kasubag Terkait']; ?>
                <?php foreach ($data_jabatan_asn as $data_ja) { ?>                  
                  <option value="<?php echo $data_ja; ?>"><?php echo $data_ja; ?></option>  
                <?php } ?>
              </select>
            </div> 
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status" style="width: 100%;">
                <?php $status = [
                  'ADA', 
                  'TIDAK ADA',
                 ]; ?>
                <?php foreach ($status as $st) { ?>                  
                  <option value="<?php echo $st; ?>"><?php echo $st; ?></option>  
                <?php } ?>
              </select>
            </div>  
        </form>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnSave" onclick="savePejabat()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- End Modal Tambah Pejabat -->




  <!-- Modal Tambah Pejabat -->
  <div class="modal" id="modal-edit-pejabat" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="#" id="form-edit-pejabat">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id_asn" name="id_asn" autocomplete="off" placeholder="id Pejabat">
              <input type="text" class="form-control" id="nama_asn" name="nama_asn" autocomplete="off" placeholder="Nama Pejabat">
            </div>
            <div class="form-group">
              <label for="jabatan_asn">Jabatan</label>
              <select class="form-control" id="jabatan_asn" name="jabatan_asn" style="width: 100%;">
               
              </select>
            </div>
                <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status" style="width: 100%;">
                <?php $status = [
                  'ADA', 
                  'TIDAK ADA',
                 ]; ?>
                <?php foreach ($status as $st) { ?>                  
                  <option value="<?php echo $st; ?>"><?php echo $st; ?></option>  
                <?php } ?>
              </select>
            </div>   
        </form>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btnSaveedit" onclick="saveeditPejabat()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- End Modal Tambah Pejabat -->





</div>
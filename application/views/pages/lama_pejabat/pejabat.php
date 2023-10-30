<!-- DataTables Example -->
<div class="card mb-3">
  <!-- Card Header Title -->
  <div class="card-header">
    <i class="fas fa-table"></i>
    Data Pejabat
  </div>
  <!-- End Card Header Title -->
  <!-- Card Body Table Pejabat -->
  <div class="card-body">
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
                <?php $data_jabatan_asn = ['Kepala Biro', 'Kabag Kerjasama Daerah', 'Kabag Pembangunan',
                                           'Kabag Rantau', 'Kasubag Pemerintah Pembangunan Manusia dan Pengendalian Data',
                                           'Kasubag Bina Ekonomi Ranah dan Rantau',
                                           'Kasubag Bina Sosial Budaya Ranah dan Rantau',
                                           'Kasubag Kerjasama Antar Daerah',
                                           'Kasubag Kerjasama dengan Pihak Ketiga',
                                           'Kasubag Kerjasama Luar Negeri',
                                           'Kasubag Pengendalian Pembangunan Sarana Prasarana Wilayah',
                                           'Kasubag Pengendalian Pembangunan Sosial Ekonomi',
                                           'Kasubag Tata Usaha',
                                           'Eselon III', 'Eselon IV', 'Seluruh Staf', 'Staff Terkait', 'PLH Kabag Pembangunan','Semua Kabag','Semua Kasubag']; ?>
                <?php foreach ($data_jabatan_asn as $data_ja) { ?>                  
                  <option value="<?php echo $data_ja; ?>"><?php echo $data_ja; ?></option>  
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
</div>